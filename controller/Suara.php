<?php

class Suara {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getSuara() {
        $stmt = $this->db->prepare("SELECT c.nama_calon_ketua, c.nama_calon_wakil_ketua, COUNT(p.id_pemilihan) AS jumlah_suara
            FROM calon c
            LEFT JOIN pemilihan p ON c.id_calon = p.id_calon
            GROUP BY c.id_calon
        ");
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Process the result or return it as needed
        return $result;
    }

    public function generateGraph() {
        $result = $this->getSuara();
        $data = '';

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data .= '{ name:"' . $row->nama_calon_ketua . ' / ' . $row->nama_calon_wakil_ketua . '", y:' . $row->jumlah_suara . ' },';
            }
        }
        return $data;


    }
}

?>
