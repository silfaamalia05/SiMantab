<?Php
namespace App\Http\Controllers;

use App\Models\BatasWilayahKecDesa;
use App\Models\ReportImage;
use App\Models\TabulasiResikoBanjir;
use Auth;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Storage;
use Validator;

class ReportController extends Controller
{
    public function index()
    {
        $data = auth()->user()->role == 'ADMIN' ? Report::latest()->get() : Report::where('users_id', '=', auth()->user()->id)->latest()->get();
        return view('reports.index', compact(['data']));
    }

    public function create()
    {
        $kec = BatasWilayahKecDesa::where('status', '=', '1')->latest()->get();
        
        return auth()->user()->role == 'ADMIN' ? view('reports.form', compact(['kec'])) : view('laporan.form', compact(['kec'])); 
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'jenis_bencana' => 'required|string',
                'waktu_kejadian' => 'required|string',
                'lokasi' => 'required|string',
                'koordinat' => 'required|string',
                'sungai' => 'nullable|string',
                'meninggal' => 'nullable|integer',
                'luka_berat' => 'nullable|integer',
                'luka_ringan' => 'nullable|integer',
                'hilang' => 'nullable|integer',
                'mengungsi' => 'nullable|integer',
                'rumah' => 'nullable|integer',
                'kantor' => 'nullable|integer',
                'fasum-faskes' => 'nullable|integer',
                'jalan-jembatan' => 'nullable|integer',
                'sawah-lahan-pertanian' => 'nullable|integer',
                'pemukiman' => 'nullable|string',
                'perkotaan' => 'nullable|string',
                'kawasan-industri' => 'nullable|string',
                'sarana-prasarana' => 'nullable|string',
                'pertanian' => 'nullable|string',
                'lama-ancaman-bahaya' => 'nullable|string',
               
            ]);

            $reportId = Uuid::uuid4()->toString();
            $validated['id'] = $reportId;
            $validated['sarpras'] = $request->sarpras != null ? $request->sarpras : '';
            $validated['tingkat_kerusakan'] = $request->tingkat_kerusakan != null ? $request->tingkat_kerusakan : '';
            $validated['fungsi_layanan'] = $request->fungsi_layanan != null ? $request->fungsi_layanan : '';
            $validated['rencana_aksi'] = $request->rencana_aksi != null ? $request->rencana_aksi : '';
            $validated['p_darurat'] = $request->p_darurat != null ? $request->p_darurat : '';
            $validated['sda'] = $request->sda != null ? $request->sda : '';
            $validated['kebutuhan'] = $request->kebutuhan != null ? $request->kebutuhan : '';
            $validated['status_laporan'] = $request->status_laporan != null ? $request->status_laporan : '';
            $validated['estimasi_selesai'] = $request->estimasi_selesai != null ? $request->estimasi_selesai : '';
            $validated['logistik'] = $request->logistik != null ? $request->logistik : '';
            $validated['estimasi_anggaran'] = $request->estimasi_anggaran != null ? $request->estimasi_anggaran : '';
            $validated['users_id'] = auth()->user()->id;
            $validated['keterangan_laporan'] = $request->keterangan_laporan != null ? $request->keterangan_laporan : '-';
            $validated['skala_prioritas'] = 0;

            if(isset($request->kdcpum) && $request->kdcpum != null && isset($request->estimasi_anggaran) && $request->estimasi_anggaran != null){
                //Skala prioritas
                $kecs = BatasWilayahKecDesa::where('KDCPUM', '=', $request->kdcpum)->first();
                $resiko = TabulasiResikoBanjir::where('batas_wilayah_kec_desa_id', '=', $kecs->id)->first();
                $rencana_aksi = $request->rencana_aksi == 'PSLB' ? 1 : 3;
                $validated['skala_prioritas'] = $this->getLastKlasifikasi($this->KelasResiko($resiko->kelas), $rencana_aksi,$request->estimasi_anggaran);
            }
            
           


            Report::create($validated);

            // Upload dokumentasi
            if ($request->hasFile('dokumentasi')) {
                $files = $request->file('dokumentasi');
                foreach ($files as $file) {
                    $filePath = $file->store('dokumentasi', 'public');

                    ReportImage::create([
                        'id' => Uuid::uuid4()->toString(),
                        'report_id' => $reportId,
                        'image_path' => $filePath
                    ]);
                }
            }

            DB::commit();

            $format = $request->input('submit_type', 'submit');

            // Memanggil route berdasarkan format yang dipilih
            if ($format == 'a') {
                return redirect()->route('reports.generate', ['format' => 'a', 'id' => $reportId]);
            } elseif ($format == 'b') {
                return redirect()->route('reports.generate', ['format' => 'b', 'id' => $reportId]);
            } else {
                return redirect()->route('reports.index')->with('success', 'Laporan berhasil, Terimakasih Sudah melapor !.');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();

            info('ERROR: Validation failed', ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors());
        }

    }

    public function show(string $id)
    {

    }
    public function edit(string $id)
    {
        $kec = BatasWilayahKecDesa::where('status', '=', '1')->latest()->get();
        $data = Report::with(['images'])->findOrFail($id);
        return view('reports.form', compact(['data', 'kec']));
    }
    public function update(Request $request, string $id)
    {

        try {
            $oldData = Report::findOrFail($id);
            DB::beginTransaction();

            $validated = $request->validate([
                'jenis_bencana' => 'required|string',
                'waktu_kejadian' => 'required|string',
                'lokasi' => 'required|string',
                'koordinat' => 'required|string',
                'sungai' => 'nullable|string',
                'meninggal' => 'nullable|integer',
                'luka_berat' => 'nullable|integer',
                'luka_ringan' => 'nullable|integer',
                'hilang' => 'nullable|integer',
                'mengungsi' => 'nullable|integer',
                'rumah' => 'nullable|integer',
                'kantor' => 'nullable|integer',
                'fasum-faskes' => 'nullable|integer',
                'jalan-jembatan' => 'nullable|integer',
                'sawah-lahan-pertanian' => 'nullable|integer',
                'pemukiman' => 'nullable|string',
                'perkotaan' => 'nullable|string',
                'kawasan-industri' => 'nullable|string',
                'sarana-prasarana' => 'nullable|string',
                'pertanian' => 'nullable|string',
                'lama-ancaman-bahaya' => 'nullable|string',
            ]);

            $validated['sarpras'] = $request->sarpras != null ? $request->sarpras : $oldData->sarpras;
            $validated['tingkat_kerusakan'] = $request->tingkat_kerusakan != null ? $request->tingkat_kerusakan :$oldData->tingkat_kerusakan;
            $validated['fungsi_layanan'] = $request->fungsi_layanan != null ? $request->fungsi_layanan :$oldData->fungsi_layanan;
            $validated['rencana_aksi'] = $request->rencana_aksi != null ? $request->rencana_aksi :$oldData->rencana_aksi;
            $validated['p_darurat'] = $request->p_darurat != null ? $request->p_darurat : $oldData->p_darurat;
            $validated['sda'] = $request->sda != null ? $request->sda : $oldData->sda;
            $validated['kebutuhan'] = $request->kebutuhan != null ? $request->kebutuhan : $oldData->kebutuhan;
            $validated['status_laporan'] = $request->status_laporan != null ? $request->status_laporan : $oldData->status_laporan;
            $validated['estimasi_selesai'] = $request->estimasi_selesai != null ? $request->estimasi_selesai : $oldData->estimasi_selesai;
            $validated['logistik'] = $request->logistik != null ? $request->logistik : $oldData->logistik;
            $validated['estimasi_anggaran'] = $request->estimasi_anggaran != null ? $request->estimasi_anggaran : $oldData->estimasi_anggaran;
            $validated['keterangan_laporan'] = $request->keterangan_laporan != null ? $request->keterangan_laporan : '-';
            $validated['skala_prioritas'] = $oldData->skala_prioritas;
            if(isset($request->kdcpum) && $request->kdcpum != null && isset($request->estimasi_anggaran) && $request->estimasi_anggaran != null){
                //Skala prioritas
                $kecs = BatasWilayahKecDesa::where('KDCPUM', '=', $request->kdcpum)->first();
                $resiko = TabulasiResikoBanjir::where('batas_wilayah_kec_desa_id', '=', $kecs->id)->first();

                $rencana_aksi = $request->rencana_aksi == 'PSLB' ? 1 : 3;
                $validated['skala_prioritas'] = $this->getLastKlasifikasi($this->KelasResiko($resiko->kelas), $rencana_aksi,$request->estimasi_anggaran);

            }

            $oldData->update($validated);

            // Upload dokumentasi
            if ($request->hasFile('dokumentasi')) {
                $files = $request->file('dokumentasi');
                foreach ($files as $file) {
                    $filePath = $file->store('dokumentasi', 'public');

                    if ($filePath) {
                        ReportImage::create([
                            'id' => Uuid::uuid4()->toString(),
                            'report_id' => $oldData->id,
                            'image_path' => $filePath
                        ]);
                    }

                }
            }

            DB::commit();

            $format = $request->input('submit_type', 'submit');

            // Memanggil route berdasarkan format yang dipilih
            if ($format == 'a') {
                return redirect()->route('reports.generate', ['format' => 'a', 'id' => $oldData->id]);
            } elseif ($format == 'b') {
                return redirect()->route('reports.generate', ['format' => 'b', 'id' => $oldData->id]);
            } else {
                return redirect()->route('reports.index')->with('success', 'Laporan berhasil diubah');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();

            info('ERROR: Validation failed', ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors());
        }
    }
    public function destroy(string $id)
    {
        $oldData = Report::findOrFail($id);
        foreach ($oldData->images as $image) {
            if (file_exists('storage/' . $image->image_path)) {
                unlink('storage/' . $image->image_path);
                Storage::delete($image->image_path);
            }
            $image->delete();
        }
        $oldData->delete();
        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dihapus');
    }

    public function deleteImages(string $id)
    {
        $oldData = ReportImage::findOrFail($id);
        if (file_exists('storage/' . $oldData->image_path)) {
            unlink('storage/' . $oldData->image_path);
            Storage::delete($oldData->image_path);
        }
        $oldData->delete();
        echo 'File Has Been deleted';
    }

    // For User

    public function formPelaporan()
    {

        $kec = BatasWilayahKecDesa::where('status', '=', '1')->latest()->get();
        return view('laporan.form', compact(['kec']));
    }
    public function storePelaporan(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'jenis_bencana' => 'required|string',
                'waktu_kejadian' => 'required|string',
                'lokasi' => 'required|string',
                'koordinat' => 'required|string',
                'sungai' => 'nullable|string',
                'meninggal' => 'nullable|integer',
                'luka_berat' => 'nullable|integer',
                'luka_ringan' => 'nullable|integer',
                'hilang' => 'nullable|integer',
                'mengungsi' => 'nullable|integer',
                'rumah' => 'nullable|integer',
                'kantor' => 'nullable|integer',
                'fasum-faskes' => 'nullable|integer',
                'jalan-jembatan' => 'nullable|integer',
                'sawah-lahan-pertanian' => 'nullable|integer',
                'pemukiman' => 'nullable|string',
                'perkotaan' => 'nullable|string',
                'kawasan-industri' => 'nullable|string',
                'sarana-prasarana' => 'nullable|string',
                'pertanian' => 'nullable|string',
                'lama-ancaman-bahaya' => 'nullable|string',
               
            ]);

            $reportId = Uuid::uuid4()->toString();
            $validated['id'] = $reportId;
            $validated['sarpras'] = $request->sarpras != null ? $request->sarpras : '';
            $validated['tingkat_kerusakan'] = $request->tingkat_kerusakan != null ? $request->tingkat_kerusakan : '';
            $validated['fungsi_layanan'] = $request->fungsi_layanan != null ? $request->fungsi_layanan : '';
            $validated['rencana_aksi'] = $request->rencana_aksi != null ? $request->rencana_aksi : '';
            $validated['p_darurat'] = $request->p_darurat != null ? $request->p_darurat : '';
            $validated['sda'] = $request->sda != null ? $request->sda : '';
            $validated['kebutuhan'] = $request->kebutuhan != null ? $request->kebutuhan : '';
            $validated['status_laporan'] = $request->status_laporan != null ? $request->status_laporan : '';
            $validated['logistik'] = $request->logistik != null ? $request->logistik : '';
            $validated['estimasi_anggaran'] = $request->estimasi_anggaran != null ? $request->estimasi_anggaran : '';
            $validated['estimasi_selesai'] = '';
            $validated['keterangan_laporan'] = '-';
            $validated['users_id'] = auth()->user()->id;
            $validated['skala_prioritas'] = 0;


            if(isset($request->kdcpum) && $request->kdcpum != null && isset($request->estimasi_anggaran) && $request->estimasi_anggaran != null){
            //Skala prioritas
                $kecs = BatasWilayahKecDesa::where('KDCPUM', '=', $request->kdcpum)->first();
                $resiko = TabulasiResikoBanjir::where('batas_wilayah_kec_desa_id', '=', $kecs->id)->first();

                $rencana_aksi = $request->rencana_aksi == 'PSLB' ? 1 : 3;
                $validated['skala_prioritas'] = $this->getLastKlasifikasi($this->KelasResiko($resiko->kelas), $rencana_aksi,$request->estimasi_anggaran);
            }

            Report::create($validated);

            // Upload dokumentasi
            if ($request->hasFile('dokumentasi')) {
                $files = $request->file('dokumentasi');
                foreach ($files as $file) {
                    $filePath = $file->store('dokumentasi', 'public');

                    ReportImage::create([
                        'id' => Uuid::uuid4()->toString(),
                        'report_id' => $reportId,
                        'image_path' => $filePath
                    ]);
                }
            }

            DB::commit();

            $format = $request->input('submit_type', 'submit');

            // Memanggil route berdasarkan format yang dipilih
            if ($format == 'a') {
                return redirect()->route('reports.generate', ['format' => 'a', 'id' => $reportId]);
            } elseif ($format == 'b') {
                return redirect()->route('reports.generate', ['format' => 'b', 'id' => $reportId]);
            } else {
                return redirect()->route('laporan.index')->with('success', 'Laporan berhasil, Terimakasih Sudah melapor !.');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();

            info('ERROR: Validation failed', ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors());
        }
    }



}
