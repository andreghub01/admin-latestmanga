<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Result;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WordpressController extends Controller
{
    public $url = "http://45.76.154.59:8081/wp-json/wp/v2/posts/";
    public $url_post = "http://45.76.154.59:8081/wp-json/wp/v2/posts/";
    public $url_media = "http://45.76.154.59:8081/wp-json/wp/v2/media/";
    public $username = 'gafriputra';
    public $password = '08563117804';

    public function toWordpress(Request $request)
    {
        $id = $request->input('id');
        if ($id) {
            $comics = Comic::where('id', $id)->with('category')->get();
        }else {
            $comics = Comic::where('status', 1)->with('category')->get();
        }

        foreach ($comics as $comic) {
            $this->updateTagComic($comic->id);
            $id_wordpress = $comic->id_wordpress;
            if ($id_wordpress == 0) {
                $this->insertChapter($comic);
            }
            else {
                $this->updateChapter($comic);
            }
        }
    }

    public function mediaToWordpress($id)
    {
        $comics = Comic::where('id', $id)->get();
        foreach ($comics as $comic) {
            $id_comic = $comic->id;
            $id_wordpress = $comic->id_wordpress;
            $id_wordpress_media = $comic->id_wordpress_media;
            $filename = $comic->image;

            if ($filename != "") {
                if ($id_wordpress_media == 0) {
                    $media = $this->uploadImages($filename);
                }
                else {
                    $media = $this->updateMedia($id_wordpress_media, $id_wordpress);
                }
                if (isset($media)) {
                    $id_wordpress_media = $media['id'];
                    $data['id_wordpress_media'] = $id_wordpress_media;
                    $item = Comic::findOrFail($id_comic);
                    $item->update($data);
                    $this->updateMedia($id_wordpress_media, $id_wordpress);
                }
            }

        }
    }
    public function updateChapter($comic)
    {
        $url = $this->url_post. $comic->id_wordpress;
        $results = $this->results($comic->id, 3);

        if ($comic->id_wordpress_media == 0) {
            if ($comic->image != "" or $comic->image != NULL) {
                $media = $this->uploadImages($comic->image);
            }
        }

        // buat params untuk dikirim ke midtrans
        $params_wp = [
                        "content" => $comic->content,
                        "categories" => $comic->category->id_wordpress_category,
                        "tags" => $comic->id_wordpress_tag,
                        "fields" =>
                        [
                            "alternative" => $comic->alternative,
                            "author" => $comic->author,
                            "language" => $comic->language,
                            "status" => $comic->detail_status,
                            "rating" => $comic->rating,
                            "genres" => $comic->genres,
                            "views" => $comic->views,
                            "list_1" => isset($results[0]) ? $results[0]->regex : 0,
                            "url_list_1" => isset($results[0]) ? $results[0]->web->url.$results[0]->short_url : false,
                            "list_2" => isset($results[1]) ? $results[1]->regex : 0,
                            "url_list_2" => isset($results[1]) ? $results[1]->web->url.$results[1]->short_url : false,
                            "list_3" => isset($results[2]) ? $results[2]->regex : 0,
                            "url_list_3" => isset($results[2]) ? $results[2]->web->url.$results[2]->short_url : false
                        ]
                    ];
        if (isset($media)) {
            $params_wp['fields']['url_image'] = $media['guid']['rendered'];
            $params_wp['fields']['featured_media'] = $media['id'];
        }elseif($comic->id_wordpress_media){
            $params_wp['featured_media'] = $comic->id_wordpress_media;
            echo $comic->id_wordpress_media."<br>";
        }

        if (isset($results[0])) {
            if ($results[0] != "") {
                $params_wp['fields']['last_update'] = $results[0]->last_update;
            }
        }elseif (isset($results[1])) {
            if ($results[1] != "") {
                $params_wp['fields']['last_update'] = $results[1]->last_update;
            }
        }elseif (isset($results[2])) {
            if ($results[2] != "") {
                $params_wp['fields']['last_update'] = $results[2]->last_update;
            }
        }

        // untuk jika berhasil dan gagal
        // print_r(json_encode($params_wp));
        echo $comic->id." update<br>";
        $params_wp = json_encode($params_wp);
        // die;
        try {
                $client = new Client();
                $res = $client->post($url, [
                    'headers' => [
                        'Authorization' => 'Basic Z2FmcmlwdXRyYTowODU2MzExNzgwNA==',
                        'Content-Type' => 'application/json'
                    ],
                    'body' => $params_wp
                ]);

                if (isset($media)) {
                    $id_wordpress_media = $media['id'];
                    $data['id_wordpress_media'] = $id_wordpress_media;
                    $comic->update($data);
                    $this->updateMedia($id_wordpress_media, $comic->id_wordpress);
                }

            }
        catch (Exception $e) {
            echo $e->getMessage();
          }

    }

    public function insertChapter($comic)
    {
        $url = $this->url_post;
        $results = $this->results($comic->id, 3);

        if ($comic->id_wordpress_media == 0) {
            if ($comic->image != "" or $comic->image != NULL) {
                $media = $this->uploadImages($comic->image);
            }
        }

        // buat params untuk dikirim ke midtrans
        $params_wp = [
                        "title" => $comic->name,
                        "content" => $comic->content,
                        "status" => "publish",
                        "type" => "post",
                        "tags" => $comic->id_wordpress_tag,
                        "categories"=> [
                            $comic->category->id_wordpress_category
                        ],
                        "fields" =>
                        [
                            "alternative" => $comic->alternative,
                            "author" => $comic->author,
                            "language" => $comic->language,
                            "status" => $comic->detail_status,
                            "rating" => $comic->rating,
                            "genres" => $comic->genres,
                            "views" => $comic->views,
                            "list_1" => isset($results[0]) ? $results[0]->regex : 0,
                            "url_list_1" => isset($results[0]) ? $results[0]->web->url.$results[0]->short_url : false,
                            "list_2" => isset($results[1]) ? $results[1]->regex : 0,
                            "url_list_2" => isset($results[1]) ? $results[1]->web->url.$results[1]->short_url : false,
                            "list_3" => isset($results[2]) ? $results[2]->regex : 0,
                            "url_list_3" => isset($results[2]) ? $results[2]->web->url.$results[2]->short_url : false
                        ]
                    ];

        if (isset($media)) {
            $params_wp['fields']['url_image'] = $media['guid']['rendered'];
            $params_wp['fields']['featured_media'] = $media['id'];
        }

        if (isset($results[0])) {
            if ($results[0] != "") {
                $params_wp['fields']['last_update'] = $results[0]->last_update;
            }
        }elseif (isset($results[1])) {
            if ($results[1] != "") {
                $params_wp['fields']['last_update'] = $results[1]->last_update;
            }
        }elseif (isset($results[2])) {
            if ($results[2] != "") {
                $params_wp['fields']['last_update'] = $results[2]->last_update;
            }
        }

        // untuk jika berhasil dan gagal
        // print_r(json_encode($params_wp));
        echo $comic->id." insert<br>";
        // die;
        $params_wp = json_encode($params_wp);
        try {
                $client = new Client();
                $response = $client->post($url, [
                    'headers' => [
                        'Authorization' => 'Basic Z2FmcmlwdXRyYTowODU2MzExNzgwNA==',
                        'Content-Type' => 'application/json'
                    ],
                    'body' => $params_wp
                ]);

                $id_wordpress = json_decode($response->getBody(), true);
                $id_wordpress = $id_wordpress['id'];
                if (isset($media)) {
                    $id_wordpress_media = $media['id'];
                    $data['id_wordpress_media'] = $id_wordpress_media;
                    $this->updateMedia($id_wordpress_media, $id_wordpress);
                }
                $data['id_wordpress'] = $id_wordpress;
                $item = Comic::findOrFail($comic->id);
                return $item->update($data);

            }
        catch (Exception $e) {
            echo $e->getMessage();
          }
    }

    public function results($id, $take)
    {

        return Result::whereHas('web', function ($query) {
                            return $query->where('status', '=', 1);
                            })
                        ->with(['web' => function($query){
                                $query->select('id','name','url', 'xpath_chapter');
                            }])
                        ->where(['id_comic'=> $id, 'status'=> 1])
                        ->orderBy('regex', 'DESC')
                        ->take($take)
                        ->get(['id','id_comic','id_web','short_url','last_chapter','last_update','regex','date_scraping']);
    }



    public function uploadImages($filename)
    {
        $url = $this->url_media;
        // $ch = curl_init();
        $username = $this->username;
        $password = $this->password;

        $request_url = $url;

        $path = 'comics/'.$filename;
        $image = file_get_contents( $path );
        $mime_type = mime_content_type( $path );
        if ($image && $mime_type) {
            $api = curl_init();

            try {

                //set the url, POST data
                curl_setopt( $api, CURLOPT_URL, $request_url );
                curl_setopt( $api, CURLOPT_POST, 1 );
                curl_setopt( $api, CURLOPT_POSTFIELDS, $image );
                curl_setopt( $api, CURLOPT_HTTPHEADER, array( 'Content-Type: ' . $mime_type, 'Content-Disposition: attachment; filename="' . basename($path) . '"' ) );
                curl_setopt( $api, CURLOPT_RETURNTRANSFER, 1 );
                curl_setopt( $api, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );
                curl_setopt( $api, CURLOPT_USERPWD, $username . ':' . $password );

                //execute post
                $result = curl_exec( $api );

                //close connection
                curl_close( $api );

                $result = json_decode($result, true);
            } catch (Exception $e) {
                echo $e->getMessage();
                $result = false;
            }
            return $result;
        }

    }

    public function updateMedia($id_wordpress_media, $id_wordpress)
    {
        $url = $this->url_media.$id_wordpress_media;

        $params_wp = [
            "post" => $id_wordpress
        ];
        try {
            $client = new Client();
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => 'Basic Z2FmcmlwdXRyYTowODU2MzExNzgwNA==',
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode($params_wp)
            ]);

        }
            catch (Exception $e) {
                echo $e->getMessage();
        }
    }

    public function saveTags()
    {
        $data = ['4 koma',
        'Action',
        'Adaptation',
        'Adult',
        'Adventure',
        'Aliens',
        'Animals',
        'Anthology',
        'Award winning',
        'Comedy',
        'Cooking',
        'Crime',
        'Crossdressing',
        'Delinquents',
        'Demons',
        'Doujinshi',
        'Drama',
        'Ecchi',
        'Fan colored',
        'Fantasy',
        'Food',
        'Full color',
        'Game',
        'Gender bender',
        'Genderswap',
        'Ghosts',
        'Gore',
        'Gossip',
        'Gyaru',
        'Harem',
        'Historical',
        'Horror',
        'Isekai',
        'Josei',
        'Kids',
        'Loli',
        'Lolicon',
        'Long strip',
        'Mafia',
        'Magic',
        'Magical girls',
        'Manhwa',
        'Martial arts',
        'Mature',
        'Mecha',
        'Medical',
        'Military',
        'Monster girls',
        'Monsters',
        'Music',
        'Mystery',
        'Ninja',
        'Office workers',
        'Official colored',
        'One shot',
        'Parody',
        'Philosophical',
        'Police',
        'Post apocalyptic',
        'Psychological',
        'Reincarnation',
        'Reverse harem',
        'Romance',
        'Samurai',
        'School life',
        'Sci fi',
        'Seinen',
        'Shota',
        'Shotacon',
        'Shoujo',
        'Shoujo ai',
        'Shounen',
        'Shounen ai',
        'Slice of life',
        'Smut',
        'Space',
        'Sports',
        'Super power',
        'Superhero',
        'Supernatural',
        'Survival',
        'Suspense',
        'Thriller',
        'Time travel',
        'Toomics',
        'Traditional games',
        'Tragedy',
        'User created',
        'Vampire',
        'Vampires',
        'Video games',
        'Virtual reality',
        'Web comic',
        'Webtoon',
        'Wuxia',
        'Yaoi',
        'Yuri',
        'Zombies'];

        for ($i=0; $i <= count($data); $i++) {
            $isi['name'] = $data[$i];
            $isi['id_wordpress_tag']= $i+8;
            $result = Tag::create($isi);
        }
    }

    public function updateTagComic($id=false)
    {
        if ($id) {
            $comics = Comic::where('id', $id)->get();

        } else {
            $comics = Comic::all();
        }

        foreach ($comics as $comic ) {
            // var_dump($comic->genres);die;
            if ($comic->genres) {
                $str = $comic->genres;
                $str = explode(",",$str);

                $id_tag = "";
                foreach ($str as $tags) {
                    $tag = Tag::where('name', 'like', '%' . $tags .'%')->first();
                    if ($tag) {
                        $id_tag .= $tag->id_wordpress_tag . ',';
                    }
                }
                $id_tag = substr($id_tag, 0, -1);
                $data['id_wordpress_tag']=$id_tag;
                $item = Comic::findOrFail($comic->id);
                return $item->update($data);
            }
        }
    }

}
