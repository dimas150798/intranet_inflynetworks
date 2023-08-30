<?php

class M_DataCustomer extends CI_Model
{
    // Menampilkan Data Customer
    public function DataCustomer()
    {
        $query   = $this->db->query("SELECT data_customer.id_customer, data_customer.pembelian_paket, data_customer.nama_customer, 
                                    data_customer.nik_customer, data_customer.alamat_customer, data_customer.tlp_customer, data_customer.date, data_customer.date_terminasi,
                                    data_customer.kode_barang, data_customer.kode_barang_stb, data_kota.nama_kota, data_kecamatan.nama_kecamatan, data_kelurahan.nama_kelurahan
                                    
                                    FROM data_customer

                                    LEFT JOIN data_kota ON data_customer.id_kota = data_kota.id_kota
                                    LEFT JOIN data_kecamatan ON data_customer.id_kecamatan = data_kecamatan.id_kecamatan
                                    LEFT JOIN data_kelurahan ON data_customer.id_kelurahan = data_kelurahan.id_kelurahan

                                    WHERE id_status IS NULL
                                    ORDER BY nama_customer ASC");

        return $query->result_array();
    }

    // Menampilkan Data Customer Terminasi
    public function DataCustomerTerminasi()
    {
        $query   = $this->db->query("SELECT data_customer.id_customer, data_customer.pembelian_paket, data_customer.nama_customer, 
                                    data_customer.nik_customer, data_customer.alamat_customer, data_customer.tlp_customer, data_customer.date,  data_customer.date_terminasi,
                                    data_customer.kode_barang, data_customer.kode_barang_stb, data_kota.nama_kota, data_kecamatan.nama_kecamatan, data_kelurahan.nama_kelurahan
                                    
                                    FROM data_customer

                                    LEFT JOIN data_kota ON data_customer.id_kota = data_kota.id_kota
                                    LEFT JOIN data_kecamatan ON data_customer.id_kecamatan = data_kecamatan.id_kecamatan
                                    LEFT JOIN data_kelurahan ON data_customer.id_kelurahan = data_kelurahan.id_kelurahan
    
                                    WHERE id_status IS NOT NULL
                                    ORDER BY nama_customer ASC");

        return $query->result_array();
    }

    //Edit Data Customer
    public function EditCustomer($id_customer)
    {
        $query   = $this->db->query("SELECT id_customer, pembelian_paket, nama_customer, nik_customer, alamat_customer, tlp_customer, date, date_terminasi, kode_barang, kode_barang_stb, id_kota, id_kecamatan, id_kelurahan 
                                    FROM data_customer
                                    WHERE id_customer = '$id_customer' ");

        return $query->result_array();
    }
}
