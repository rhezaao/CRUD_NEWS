<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class NewsModel extends Model
{
    protected $table = 'news';
    protected $allowedFields =
    [
        'active'
        , 'body'
        , 'image'
        , 'publish_date'
        , 'slug'
        , 'title'
    ];
 
    public function getNews($id = '')
    {
        if ($id === '')
        {
            return $this->asObject()
                    ->orderBy('publish_date', 'desc')
                    ->findAll();
        }
 
        return $this->asObject()
                    ->where(['id' => $id])
                    ->first();
 
    }
 
    public function getPageSlug($slug = false)
    {
        return $this->asObject()
                    ->where(['slug' => $slug])
                    ->first();
    }
 
    function checkSlug($string){
        $str=$string;
        $query = "SELECT * from news WHERE slug like '%".$string."%' ";
        $data = $this->db->query($query);
        $countResult = count($data->getResultArray());
        if ($countResult > 0) {
            $str=$str.'-'.$countResult;
        }
        return $str;                   
    }
 
    public function getLatestNews()
    {
        return $this->asObject()
                    ->orderBy('publish_date', 'desc')
                    ->findAll(1);
 
    }
 
    public function make_query($publish_date, $title, $body)
    {
        $query = "
        SELECT * from news
        WHERE 1=1
        ";
 
        if (isset($body)) {
            $body = substr($this->db->escape($body), 1, -1);
            $query .= "
                AND body like '%".$body."%'
            ";
        }
 
        if (isset($publish_date) && $publish_date !== '') {
            $query .= "
                AND publish_date='".$publish_date."'
            ";
        }
 
        if (isset($title)) {
            $title = substr($this->db->escape($title), 1, -1);
            $query .= "
                AND title like '%".$title."%'
            ";
        }
 
        return $query;
    }
 
    public function fetch_data($limit, $start, $publish_date, $title, $body)
    {
        $query = $this->make_query($publish_date, $title, $body);
        $query .= ' LIMIT '.$start.', '.$limit;
        $data = $this->db->query($query);
        return $data->getResult();
    }
 
    public function count_all($publish_date, $title, $body)
    {
        $query = $this->make_query($publish_date, $title, $body);
        $data = $this->db->query($query);
 
        return count($data->getResultArray());
    }
}