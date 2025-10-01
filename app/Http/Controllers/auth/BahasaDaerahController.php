<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BahasaDaerahController extends Controller
{
    public function index()
    {
        return view('pages.bahasa_daerah.bahasa');
    }

    public function bahasaJawa()
    {
        $data = [
            'progress' => 65,
            'lessons' => [
                [
                    'id' => 1,
                    'title' => 'Pengenalan Aksara Jawa',
                    'status' => 'Selesai',
                    'completed' => true
                ],
                [
                    'id' => 2,
                    'title' => 'Tingkat Tutur Ngoko',
                    'status' => 'Selesai',
                    'completed' => true
                ],
                [
                    'id' => 3,
                    'title' => 'Tingkat Tutur Krama',
                    'status' => 'Belum Selesai',
                    'completed' => false
                ],
                [
                    'id' => 4,
                    'title' => 'Percakapan Sehari-hari',
                    'status' => 'Belum Selesai',
                    'completed' => false
                ]
            ],
            'stats' => [
                'completed_lessons' => '2/4',
                'study_time' => '12 jam',
                'streak' => '5 hari'
            ]
        ];

        return view('pages.bahasa_daerah.other_bahasa.bahasa_jawa', $data);
    }

    public function bahasaMadura()
    {
        $data = [
            'progress' => 65,
            'lessons' => [
                [
                    'id' => 1,
                    'title' => 'Pengenalan Huruf Madura',
                    'status' => 'Selesai',
                    'completed' => true
                ],
                [
                    'id' => 2,
                    'title' => 'Sapaan dan Perkenalan',
                    'status' => 'Selesai',
                    'completed' => true
                ],
                [
                    'id' => 3,
                    'title' => 'Angka 1-100',
                    'status' => 'Belum Selesai',
                    'completed' => false
                ],
                [
                    'id' => 4,
                    'title' => 'Kosakata Keluarga',
                    'status' => 'Belum Selesai',
                    'completed' => false
                ]
            ],
            'stats' => [
                'completed_lessons' => '2/4',
                'study_time' => '12 jam',
                'streak' => '5 hari'
            ]
        ];

        return view('pages.bahasa_daerah.other_bahasa.bahasa_madura', $data);
    }
    public function bahasaOsing()
    {
        $data = [
            'progress' => 65,
            'lessons' => [
                [
                    'id' => 1,
                    'title' => 'Pengenalan Bahasa Osing',
                    'status' => 'Selesai',
                    'completed' => true
                ],
                [
                    'id' => 2,
                    'title' => 'Kosakata Dasar',
                    'status' => 'Selesai',
                    'completed' => true
                ],
                [
                    'id' => 3,
                    'title' => 'Percakapan Dasar',
                    'status' => 'Belum Selesai',
                    'completed' => false
                ],
                [
                    'id' => 4,
                    'title' => 'Lagu dan Pantun Osing',
                    'status' => 'Belum Selesai',
                    'completed' => false
                ]
            ],
            'stats' => [
                'completed_lessons' => '2/4',
                'study_time' => '12 jam',
                'streak' => '5 hari'
            ]
        ];

        return view('pages.bahasa_daerah.other_bahasa.bahasa_osing', $data);
    }
}
