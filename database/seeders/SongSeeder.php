<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('songs')->insert([
            [
                'no' => 'PS 319',
                'title' => 'PS 319 Wahai saudara',
                'link' => 'http://www.lagumisa.web.id/lagu.php?&f=ps-319',
                'lyrics' => "Wahai saudara, siapkanlah diri
                mari menghadap Tuhan Allahmu.
                Mari saudara, satukanlah hati
                di dalam kurban Kristus Tuhanmu.
                
                Kita pendosa yang diundang pesta
                memuliakan Allah, Bapa kita
                Marilah menghadap Tuhan Allahmu
                di dalam kurban Kristus Tuhanmu.",
            ],
            [
                'no' => 'PS 320',
                'title' => 'PS 320 Awalilah kurbanmu',
                'link' => 'http://www.lagumisa.web.id/lagu.php?&f=ps-320',
                'lyrics' => "1. Awalilah kurbanmu pada Tuhan, siapkanlah hatimu. 
                Curahkanlah hati nurani kita, persatukanlah dengan-Nya. 
                Mohon kuat dalam percaya, besarkan pengharapanmu. 
                Mohon karunia dan rahmat Tuhan, agar cinta Tuhan dan teman.
             
             2. Sadarilah: Kristus bersama kita mengurbankan diri-Nya. 
                Hayatilah kasih karunia-Nya, dalam sabda dan santapan. 
                Agar kita diselamatkan dan hidup mengikutinya. 
                Rayakanlah dalam pesta ini pesta keselamatan kekal. 
              
             3. Muliakanlah Allah Bapa di surga yang mengutus Putra-Nya. 
                Bersyukurlah atas rahmat kasih-Nya bagi umat manusia. 
                Diangkat-Nya kita semua menjadi anak-anak-Nya. 
                Kita diundang datang ke pesta kini dan kelak di surga-Nya.",
            ],
            [
                'no' => 'PS 321',
                'title' => 'PS 321 Wahai umat',
                'link' => 'http://www.lagumisa.web.id/lagu.php?&f=ps-321',
                'lyrics' => "1. Wahai, umat, sampaikan kurbanmu di altar Tuhan Allahmu 
                dan siapkanlah jiwa ragamu untuk memuji nama-Nya. 
                Walau tak pantas karena dosa, kita percaya kasih-Nya. 
                Unjukkanlah sembah dan kurbanmu, jadikan tanda tobatmu.
             
             2. Wahai umat, sampaikan syukurmu di hadap Tuhan Allahmu; 
                ingatlah akan kasih karunia, yang dicurahkan padamu. 
                Bapa mengutus Yesus Sang Putra agar selamat umat-Nya. 
                Sambutlah Sabda dalam hatimu dan rayakanlah kurban-Nya.",
            ],
            [
                'no' => 'PS 322',
                'title' => 'PS 322 Saudara, mari semua',
                'link' => 'http://www.lagumisa.web.id/lagu.php?&f=ps-321',
                'lyrics' => "Ulangan: 
                Saudara, mari semua, hadaplah altar Tuhan kita. 
                Sambut Tubuh dan Darah dari Putera Allah. 
                Allelu, allelu, allelu, alleluya.
             
                Ayat:
                1. Kita adalah satu, ingin hidup yang baru, 
                    satu budi dan hati dalam Roh ilahi.
                    
                2. Satu dalam sabda-Nya: Kasihi sesamamu! 
                    Dalam suka dan duka kita satu padu.  
                    
                3. Satukanlah dunia, jadikan keluarga 
                    dalam cinta yang mesra agar bahagia. 
                ",
            ],
            [
                'no' => 'PS 323',
                'title' => 'PS 323 Bergemarlah dan bersukaria',
                'link' => 'http://www.lagumisa.web.id/lagu.php?&f=ps-323',
                'lyrics' => "Bergemarlah dan bersukaria angkatlah nyanyian,
                puji bagi Tuhan yang mahabaik.
                
                Ayat.
                1.	Hai, pujilah Tuhan sebab Ia baik, 
                    sebab kasih Tuhan kekal tak terhingga!
                    
                2.	Biarlah mereka yang t'lah ditebus-Nya, berkata, 
                    Abadilah kasih setia Tuhan Alah.
                    
                3.	Biarlah penuh sorak-sorai, 
                    mereka yang t'lah ditebus dari kuasa penindas.
                    
                4.	Biarlah mereka bersatu; 
                    mereka yang dihimpun-Nya dari s'luruh penjuru dunia.
                    
                5.	Biarlah sekalian orang bersyukur, 
                    sebab limpah Tuhan memuaskan yang lapar dan yang dahaga.
                    
                6.	Biarlah Tuhan dimuliakan dalam jemaat, 
                    sebab dilenyapkan oleh-Nya penyakit, bencana dan maut.
                    
                7.	Pun kita bernyanyi, bersyukur, mengagungkan Tuhan. 
                    Padukanlah suara meluhurkan Dia yang maha pemurah!",
            ],
        ]);
    }
}
