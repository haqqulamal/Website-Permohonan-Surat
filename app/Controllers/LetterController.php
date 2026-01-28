<?php

namespace App\Controllers;

use App\Models\PermohonanModel;
use Mpdf\Mpdf;

class LetterController extends BaseController
{
    public function download($id_surat)
    {
        $model = new PermohonanModel();

        $data = $model->select('permohonan_sk.*, penduduk.*')
            ->join('penduduk', 'permohonan_sk.id_penduduk = penduduk.id_penduduk')
            ->find($id_surat);

        if (!$data || $data['status'] !== 'disahkan_lurah') {
            return redirect()->back()->with('error', 'Surat belum disahkan atau tidak ditemukan.');
        }

        // Authorization check
        if (session()->get('role_name') == 'penduduk' && $data['id_penduduk'] != session()->get('id_penduduk')) {
            return redirect()->to(base_url('/dashboard'))->with('error', 'Unauthorized access.');
        }

        $mpdf = new Mpdf();

        $html = "
        <div style='text-align: center; border-bottom: 2px solid black; padding-bottom: 2px;'>
            <h3 style='margin-bottom: 0;'>PEMERINTAH KABUPATEN SLEMAN</h3>
            <h4 style='margin: 0;'>KAPANEWON DEPOK</h4>
            <h2 style='margin-top: 5px;'>KALURAHAN CATURTUNGGAL</h2>
            <p style='font-size: 10px; margin: 0;'>Jl. Solo Km. 7, Caturtunggal, Depok, Sleman, Yogyakarta 55281</p>
        </div>

        <div style='text-align: center; margin-top: 20px;'>
            <u><h3>SURAT KETERANGAN</h3></u>
            <p>Nomor: {$id_surat}/SK/" . date('Y') . "</p>
        </div>

        <div style='margin-top: 30px; font-size: 14px;'>
            <p>Yang bertanda tangan di bawah ini Lurah Caturtunggal, Menerangkan bahwa:</p>
            <table style='width: 100%; margin-left: 20px; border-collapse: collapse;'>
                <tr><td style='width: 180px; padding: 5px;'>Nama Lengkap</td><td>: <b>" . strtoupper($data['nama_lengkap']) . "</b></td></tr>
                <tr><td style='padding: 5px;'>NIK</td><td>: {$data['nik']}</td></tr>
                <tr><td style='padding: 5px;'>Alamat</td><td>: {$data['alamat']}</td></tr>
                <tr><td style='padding: 5px; vertical-align: top;'>Jenis Permohonan</td><td>: <b>{$data['jenis_permohonan']}</b></td></tr>
                <tr><td style='padding: 5px; vertical-align: top;'>Keterangan</td><td>: {$data['keterangan']}</td></tr>
            </table>
            
            <p style='margin-top: 30px;'>Keterangan ini diberikan berdasarkan catatan yang ada serta sepengetahuan kami untuk dipergunakan sebagaimana mestinya.</p>
        </div>

        <div style='margin-top: 50px; float: right; text-align: center; width: 250px;'>
            <p>Yogyakarta, " . date('d F Y') . "</p>
            <p>Lurah Caturtunggal</p>
            <br><br><br><br>
            <p><b>( H. MUSLIH )</b></p>
        </div>
        ";

        $mpdf->WriteHTML($html);

        // Output the dynamic filename
        $filename = "Surat_" . str_replace(' ', '_', $data['jenis_permohonan']) . "_" . str_replace(' ', '_', $data['nama_lengkap']) . ".pdf";

        return $this->response->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($mpdf->Output('', 'S'));
    }
}
