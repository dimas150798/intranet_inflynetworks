<?php

defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

//Memanggil class dari PhpSpreadsheet dengan namespace
use PhpOffice\PhpSpreadsheet\Spreadsheet;


if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

class C_Export_Excel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == null) {

            // Notifikasi Login Terlebih Dahulu
            $this->session->set_flashdata('BelumLogin_icon', 'error');
            $this->session->set_flashdata('BelumLogin_title', 'Login Terlebih Dahulu');

            redirect('C_FormLogin');
        }
    }

    public function index()
    {
        if ($this->session->userdata('tahunGET') != NULL && $this->session->userdata('bulanGET') != NULL) {
            $data = $this->M_DataOrder->DataOrderExcel($this->session->userdata('tahunGET'), $this->session->userdata('bulanGET'));

            /* Spreadsheet Init */
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // tambpilaN judul
            $styleJudul = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ],
            ];

            // tambpilan border atas
            $styleHeader = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ],
                'borders' => [
                    'top' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'right' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'left' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];

            // tampilkan border bawah
            $styleTables = [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ],
                'borders' => [
                    'top' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'right' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'left' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];

            /* Excel Header */
            $sheet->setCellValue('A1', 'PT. Urban Teknologi Nusantara');
            $sheet->setCellValue('A2', 'Laporan Transaksi Pengeluaran Pada ' . ' Bulan ' . $this->session->userdata('bulanGET') . ' Tahun ' . $this->session->userdata('tahunGET'));

            // Merubah ukuran font
            $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(17);
            $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setSize(17);

            // MERGE
            $spreadsheet->getActiveSheet()->mergeCells('A1:M1');
            $spreadsheet->getActiveSheet()->mergeCells('A2:M2');

            // Merubah tampilan border
            $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($styleJudul);
            $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($styleJudul);

            $sheet->setCellValue('A4', 'No');
            $sheet->setCellValue('B4', 'Invoice Order');
            $sheet->setCellValue('C4', 'Nama Pembayaran');
            $sheet->setCellValue('D4', 'Tanggal Transaksi');
            $sheet->setCellValue('E4', 'Nama Toko / Supplier');
            $sheet->setCellValue('F4', 'Jumlah Bayar');
            $sheet->setCellValue('G4', 'Biaya Ongkir');
            $sheet->setCellValue('H4', 'Biaya Penanganan');
            $sheet->setCellValue('I4', 'Biaya Layanan');
            $sheet->setCellValue('J4', 'Biaya Angsuran');
            $sheet->setCellValue('K4', 'Biaya Angsuran');
            $sheet->setCellValue('L4', 'Keterangan');


            // Merubah huruf
            $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman');

            // Merubah tampilan border
            $spreadsheet->getActiveSheet()->getStyle('A4')->applyFromArray($styleHeader);
            $spreadsheet->getActiveSheet()->getStyle('B4')->applyFromArray($styleHeader);
            $spreadsheet->getActiveSheet()->getStyle('C4')->applyFromArray($styleHeader);
            $spreadsheet->getActiveSheet()->getStyle('D4')->applyFromArray($styleHeader);
            $spreadsheet->getActiveSheet()->getStyle('E4')->applyFromArray($styleHeader);
            $spreadsheet->getActiveSheet()->getStyle('F4')->applyFromArray($styleHeader);
            $spreadsheet->getActiveSheet()->getStyle('G4')->applyFromArray($styleHeader);
            $spreadsheet->getActiveSheet()->getStyle('H4')->applyFromArray($styleHeader);
            $spreadsheet->getActiveSheet()->getStyle('I4')->applyFromArray($styleHeader);
            $spreadsheet->getActiveSheet()->getStyle('J4')->applyFromArray($styleHeader);
            $spreadsheet->getActiveSheet()->getStyle('K4')->applyFromArray($styleHeader);
            $spreadsheet->getActiveSheet()->getStyle('L4')->applyFromArray($styleHeader);

            // Merubah ukuran font
            $spreadsheet->getActiveSheet()->getStyle('A4')->getFont()->setSize(14);
            $spreadsheet->getActiveSheet()->getStyle('B4')->getFont()->setSize(14);
            $spreadsheet->getActiveSheet()->getStyle('C4')->getFont()->setSize(14);
            $spreadsheet->getActiveSheet()->getStyle('D4')->getFont()->setSize(14);
            $spreadsheet->getActiveSheet()->getStyle('E4')->getFont()->setSize(14);
            $spreadsheet->getActiveSheet()->getStyle('F4')->getFont()->setSize(14);
            $spreadsheet->getActiveSheet()->getStyle('G4')->getFont()->setSize(14);
            $spreadsheet->getActiveSheet()->getStyle('H4')->getFont()->setSize(14);
            $spreadsheet->getActiveSheet()->getStyle('I4')->getFont()->setSize(14);
            $spreadsheet->getActiveSheet()->getStyle('J4')->getFont()->setSize(14);
            $spreadsheet->getActiveSheet()->getStyle('K4')->getFont()->setSize(14);
            $spreadsheet->getActiveSheet()->getStyle('L4')->getFont()->setSize(14);

            // merubah ukuran border
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);

            /* Excel Data */
            $sheet->setCellValue('A4', 'No');
            $sheet->setCellValue('B4', 'Invoice Order');
            $sheet->setCellValue('C4', 'Nama Pembayaran');
            $sheet->setCellValue('D4', 'Tanggal Transaksi');
            $sheet->setCellValue('E4', 'Nama Toko / Supplier');
            $sheet->setCellValue('F4', 'Jumlah Bayar');
            $sheet->setCellValue('G4', 'Biaya Ongkir');
            $sheet->setCellValue('H4', 'Biaya Penanganan');
            $sheet->setCellValue('I4', 'Biaya Layanan');
            $sheet->setCellValue('J4', 'Biaya Angsuran');
            $sheet->setCellValue('K4', 'Biaya Lainnya');
            $sheet->setCellValue('L4', 'Keterangan');

            $row_number = 5;
            foreach ($data as $key => $row) {
                $sheet->setCellValue('A' . $row_number, $key + 1);
                $sheet->setCellValue('B' . $row_number, $row['no_purchase_order']);
                $sheet->setCellValue('C' . $row_number, $row['nama_barang']);

                // Mengubah format tanggal menjadi tanggal Indonesia (contoh: 20 September 2023)
                $tanggal = date('d F Y', strtotime($row['tanggal']));
                $sheet->setCellValue('D' . $row_number, $tanggal);

                $sheet->setCellValue('E' . $row_number, $row['nama_supplier']);

                $sheet->setCellValue('F' . $row_number, $row['harga_barang']);

                // Menggunakan kondisi untuk mengecek apakah biaya ongkir null atau tidak
                if ($row['biaya_ongkir'] !== null) {
                    $sheet->setCellValue('G' . $row_number, $row['biaya_ongkir']);
                } else {
                    $sheet->setCellValue('G' . $row_number, '0'); // Ganti dengan teks yang sesuai jika null
                }

                // Menggunakan kondisi untuk mengecek apakah biaya penanganan null atau tidak
                if ($row['biaya_penanganan'] !== null) {
                    $sheet->setCellValue('H' . $row_number, $row['biaya_penanganan']);
                } else {
                    $sheet->setCellValue('H' . $row_number, '0'); // Ganti dengan teks yang sesuai jika null
                }

                // Menggunakan kondisi untuk mengecek apakah biaya layanan null atau tidak
                if ($row['biaya_penanganan'] !== null) {
                    $sheet->setCellValue('I' . $row_number, $row['biaya_layanan']);
                } else {
                    $sheet->setCellValue('I' . $row_number, '0'); // Ganti dengan teks yang sesuai jika null
                }

                // Menggunakan kondisi untuk mengecek apakah biaya angsuran null atau tidak
                if ($row['biaya_penanganan'] !== null) {
                    $sheet->setCellValue('J' . $row_number, $row['biaya_angsuran']);
                } else {
                    $sheet->setCellValue('J' . $row_number, '0'); // Ganti dengan teks yang sesuai jika null
                }

                // Menggunakan kondisi untuk mengecek apakah biaya lainnya null atau tidak
                if ($row['biaya_penanganan'] !== null) {
                    $sheet->setCellValue('K' . $row_number, $row['biaya_lainnya']);
                } else {
                    $sheet->setCellValue('K' . $row_number, '0'); // Ganti dengan teks yang sesuai jika null
                }

                $sheet->setCellValue('L' . $row_number, $row['keterangan']);

                $spreadsheet->getActiveSheet()->getStyle('A' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('B' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('C' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('D' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('E' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('F' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('G' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('H' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('I' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('J' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('K' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('L' . $row_number)->applyFromArray($styleTables);

                // Convert nominal indonesia
                $spreadsheet->getActiveSheet()->getStyle('F' . $row_number)->getNumberFormat()->setFormatCode('#,##0');
                $spreadsheet->getActiveSheet()->getStyle('G' . $row_number)->getNumberFormat()->setFormatCode('#,##0');
                $spreadsheet->getActiveSheet()->getStyle('H' . $row_number)->getNumberFormat()->setFormatCode('#,##0');
                $spreadsheet->getActiveSheet()->getStyle('I' . $row_number)->getNumberFormat()->setFormatCode('#,##0');
                $spreadsheet->getActiveSheet()->getStyle('J' . $row_number)->getNumberFormat()->setFormatCode('#,##0');
                $spreadsheet->getActiveSheet()->getStyle('K' . $row_number)->getNumberFormat()->setFormatCode('#,##0');

                // Merubah ukuran font
                $spreadsheet->getActiveSheet()->getStyle('A' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('B' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('C' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('D' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('E' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('F' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('G' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('H' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('I' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('J' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('K' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('L' . $row_number)->getFont()->setSize(12);

                $row_number++;
            }

            // Write an .xlsx file
            $date = date('d-m-y-' . substr((string)microtime(), 1, 8));
            $date = str_replace(".", "", $date);
            $filename = "Laporan Transaksi Pengeluaran Bulan " . $this->session->userdata('bulanGET') . " Tahun " . $this->session->userdata('tahunGET');
            $filePath = __DIR__ . DIRECTORY_SEPARATOR . $filename; //make sure you set the right permissions and change this to the path you want

            try {
                $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
                $writer->save($filePath);
            } catch (Exception $e) {
                exit($e->getMessage());
            }


            // redirect output to client browser
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
            header('Cache-Control: max-age=0');

            // Menyimpan hasil ekspor ke output langsung (tanpa menyimpan ke file)
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save('php://output');

            // Keluar dari skrip
            exit;
        } else {
            $data = $this->M_DataOrder->DataOrderExcel($this->session->userdata('tahun'), $this->session->userdata('bulan'));

            /* Spreadsheet Init */
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // tambpilaN judul
            $styleJudul = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ],
            ];

            // tambpilan border atas
            $styleHeader = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ],
                'borders' => [
                    'top' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'right' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'left' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];

            // tampilkan border bawah
            $styleTables = [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ],
                'borders' => [
                    'top' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'right' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'left' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];

            /* Excel Header */
            $sheet->setCellValue('A1', 'PT. Urban Teknologi Nusantara');
            $sheet->setCellValue('A2', 'LAPORAN PEMBELIAN PADA ' . ' Bulan ' . $this->session->userdata('bulanGET') . ' Tahun ' . $this->session->userdata('tahunGET'));

            // Merubah ukuran font
            $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(17);
            $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setSize(17);

            // MERGE
            $spreadsheet->getActiveSheet()->mergeCells('A1:M1');
            $spreadsheet->getActiveSheet()->mergeCells('A2:M2');

            // Merubah tampilan border
            $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($styleJudul);
            $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($styleJudul);

            /* Excel Data */
            $sheet->setCellValue('A4', 'No');
            $sheet->setCellValue('B4', 'Invoice Order');
            $sheet->setCellValue('C4', 'Nama Pembayaran');
            $sheet->setCellValue('D4', 'Tanggal Transaksi');
            $sheet->setCellValue('E4', 'Nama Toko / Supplier');
            $sheet->setCellValue('F4', 'Jumlah Bayar');
            $sheet->setCellValue('G4', 'Biaya Ongkir');
            $sheet->setCellValue('H4', 'Biaya Penanganan');
            $sheet->setCellValue('I4', 'Biaya Layanan');
            $sheet->setCellValue('J4', 'Biaya Angsuran');
            $sheet->setCellValue('K4', 'Biaya Lainnya');
            $sheet->setCellValue('L4', 'Keterangan');

            $row_number = 5;
            foreach ($data as $key => $row) {
                $sheet->setCellValue('A' . $row_number, $key + 1);
                $sheet->setCellValue('B' . $row_number, $row['no_purchase_order']);
                $sheet->setCellValue('C' . $row_number, $row['nama_barang']);

                // Mengubah format tanggal menjadi tanggal Indonesia (contoh: 20 September 2023)
                $tanggal = date('d F Y', strtotime($row['tanggal']));
                $sheet->setCellValue('D' . $row_number, $tanggal);

                $sheet->setCellValue('E' . $row_number, $row['nama_supplier']);

                $sheet->setCellValue('F' . $row_number, $row['harga_barang']);

                // Menggunakan kondisi untuk mengecek apakah biaya ongkir null atau tidak
                if ($row['biaya_ongkir'] !== null) {
                    $sheet->setCellValue('G' . $row_number, $row['biaya_ongkir']);
                } else {
                    $sheet->setCellValue('G' . $row_number, '0'); // Ganti dengan teks yang sesuai jika null
                }

                // Menggunakan kondisi untuk mengecek apakah biaya penanganan null atau tidak
                if ($row['biaya_penanganan'] !== null) {
                    $sheet->setCellValue('H' . $row_number, $row['biaya_penanganan']);
                } else {
                    $sheet->setCellValue('H' . $row_number, '0'); // Ganti dengan teks yang sesuai jika null
                }

                // Menggunakan kondisi untuk mengecek apakah biaya layanan null atau tidak
                if ($row['biaya_penanganan'] !== null) {
                    $sheet->setCellValue('I' . $row_number, $row['biaya_layanan']);
                } else {
                    $sheet->setCellValue('I' . $row_number, '0'); // Ganti dengan teks yang sesuai jika null
                }

                // Menggunakan kondisi untuk mengecek apakah biaya angsuran null atau tidak
                if ($row['biaya_penanganan'] !== null) {
                    $sheet->setCellValue('J' . $row_number, $row['biaya_angsuran']);
                } else {
                    $sheet->setCellValue('J' . $row_number, '0'); // Ganti dengan teks yang sesuai jika null
                }

                // Menggunakan kondisi untuk mengecek apakah biaya lainnya null atau tidak
                if ($row['biaya_penanganan'] !== null) {
                    $sheet->setCellValue('K' . $row_number, $row['biaya_lainnya']);
                } else {
                    $sheet->setCellValue('K' . $row_number, '0'); // Ganti dengan teks yang sesuai jika null
                }

                $sheet->setCellValue('L' . $row_number, $row['keterangan']);

                $spreadsheet->getActiveSheet()->getStyle('A' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('B' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('C' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('D' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('E' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('F' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('G' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('H' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('I' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('J' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('K' . $row_number)->applyFromArray($styleTables);
                $spreadsheet->getActiveSheet()->getStyle('L' . $row_number)->applyFromArray($styleTables);

                // Convert nominal indonesia
                $spreadsheet->getActiveSheet()->getStyle('F' . $row_number)->getNumberFormat()->setFormatCode('#,##0');
                $spreadsheet->getActiveSheet()->getStyle('G' . $row_number)->getNumberFormat()->setFormatCode('#,##0');
                $spreadsheet->getActiveSheet()->getStyle('H' . $row_number)->getNumberFormat()->setFormatCode('#,##0');
                $spreadsheet->getActiveSheet()->getStyle('I' . $row_number)->getNumberFormat()->setFormatCode('#,##0');
                $spreadsheet->getActiveSheet()->getStyle('J' . $row_number)->getNumberFormat()->setFormatCode('#,##0');
                $spreadsheet->getActiveSheet()->getStyle('K' . $row_number)->getNumberFormat()->setFormatCode('#,##0');

                // Merubah ukuran font
                $spreadsheet->getActiveSheet()->getStyle('A' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('B' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('C' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('D' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('E' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('F' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('G' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('H' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('I' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('J' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('K' . $row_number)->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle('L' . $row_number)->getFont()->setSize(12);

                $row_number++;
            }

            // Write an .xlsx file
            $date = date('d-m-y-' . substr((string)microtime(), 1, 8));
            $date = str_replace(".", "", $date);
            $filename = "Laporan Transaksi Pengeluaran Bulan " . $this->session->userdata('bulan') . " Tahun " . $this->session->userdata('tahun');
            $filePath = __DIR__ . DIRECTORY_SEPARATOR . $filename; //make sure you set the right permissions and change this to the path you want

            try {
                $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
                $writer->save($filePath);
            } catch (Exception $e) {
                exit($e->getMessage());
            }
            // redirect output to client browser
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
            header('Cache-Control: max-age=0');

            // Menyimpan hasil ekspor ke output langsung (tanpa menyimpan ke file)
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save('php://output');

            // Keluar dari skrip
            exit;
        }
    }
}
