<?php

class UploadHandler {
    private $femaleWinners = [];
    private $maleWinners = [];

    public function handleUpload($femaleFile, $maleFile) {
        $this->femaleWinners = $this->processCSV($femaleFile['tmp_name']);
        $this->maleWinners = $this->processCSV($maleFile['tmp_name']);
    }

    private function processCSV($filePath) {
        $winners = [];
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            fgetcsv($handle, 1000, ",");
            
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $data = array_map(function($value) {
                    return trim($value ?? '');
                }, $data);

                if (isset($data[1], $data[2], $data[3], $data[4])) {
                    $winners[] = [
                        'year'  => $data[1],
                        'age'   => $data[2],
                        'name'  => $data[3],
                        'movie' => $data[4]
                    ];
                }
            }
            fclose($handle);
        }
        return $winners;
    }

    public function getOscarsByYear() {
        $oscarOverview = [];
        foreach ($this->femaleWinners as $female) {
            $year = $female['year'];
            $oscarOverview[$year]['women'] = $female['name'] . ' (' . $female['age'] . ')<br>' . $female['movie'];
        }
        foreach ($this->maleWinners as $male) {
            $year = $male['year'];
            $oscarOverview[$year]['men'] = $male['name'] . ' (' . $male['age'] . ')<br>' . $male['movie'];
        }
        ksort($oscarOverview);
        return $oscarOverview;
    }

    public function getMoviesWithBothAwards() {
        $movies = [];
        foreach ($this->femaleWinners as $female) {
            foreach ($this->maleWinners as $male) {
                if ($female['year'] == $male['year'] && $female['movie'] == $male['movie']) {
                    $movies[] = [
                        'title' => $female['movie'],
                        'year' => $female['year'],
                        'actress' => $female['name'] . ' (' . $female['age'] . ')',
                        'actor' => $male['name'] . ' (' . $male['age'] . ')'
                    ];
                }
            }
        }
        usort($movies, function($a, $b) {
            return strcmp($a['title'], $b['title']);
        });
        return $movies;
    }
}
