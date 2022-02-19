<?php
 
namespace App\Controllers;
 
use App\Models\NewsModel;
 
class News extends BaseController
{
    public function index()
    {
        return redirect()->to(base_url('/news/list?page=1'));
    }
 
    public function list()
    {
        $pager = \Config\Services::pager();
        $model = new NewsModel();
        $body = $this->request->getVar('body');
        $publish_date = $this->request->getVar('publish_date');
        $vartitle = $this->request->getVar('title');
         
        $per_page = 5;
        $page = $this->request->getVar('page');
        $start = ($page -1) * $per_page;
 
        $data = [
            'body' => $body,
            'vartitle' => $vartitle,
            'publish_date' => $publish_date,
            'per_page' => $per_page,
            'start' => $start,
            'page' => $page,
            'pager' => $pager
        ];
 
        $data['count_all'] = $model->count_all($publish_date, $vartitle, $body);
         
        $data['news'] = $model->fetch_data($per_page, $start < 0 ? 0 : $start, $publish_date, $vartitle, $body);
 
        if($data['count_all']>0 && count($data['news'])===0) {
            $page = 1;
            $start = ($page -1) * $per_page;
            $data['news'] = $model->fetch_data($per_page, $start < 0 ? 0 : $start, $publish_date, $vartitle, $body);
        }
 
        $data['start'] = $start;       
        $data['page'] = $page;
 
        $data['menu'] = 'news';       
        $data['title'] = 'Berita-berita';
         
        return view('news/index', $data);
    }

    public function add()
{
    $data['title'] = 'Tambah Berita';
    $data['menu'] = 'news';
    return view('news/add', $data);
}
 
public function save()
{
    $rules = [
        'body' => 'required',
        'image_file'     => 'uploaded[image_file]|is_image[image_file]',
        'title' => 'required'
    ];
 
    if($this->validate($rules)){
        $model = new NewsModel();
        $fileImage_name = "";
        if(isset($_FILES) && @$_FILES['image_file']['error'] != '4') {
            if($fileImage = $this->request->getFile('image_file')) {
                if (! $fileImage->isValid()) {
                    throw new \RuntimeException($fileImage->getErrorString().'('.$fileImage->getError().')');
                } else {           
 
                    $fileImage->move('images/news');
                    $fileImage_name = $fileImage->getName();
                }
            }
        }
 
        $slug = $model->checkSlug(url_title($this->request->getVar('title'), '-', TRUE));
        $data = [
            'body' => $this->request->getVar('body'),
            'slug' => $slug,
            'title' => $this->request->getVar('title'),
            'image' => $fileImage_name,
            'publish_date'    => $this->request->getVar('publish_date')
        ];
         
        $model->save($data);
 
        return redirect()->to(base_url('/news/list?page=1'));
 
    } else {
        $data['validation'] = $this->validator;
        $data['title'] = 'Tambah Berita';
        $data['menu'] = 'news';
        return view('news/add', $data);
    }
}

public function edit($id)
{
    $model = new NewsModel();
 
    $data['news'] = $model->getNews($id);
    $data['title'] = 'Update Berita';
    $data['menu'] = 'news';
    return view('news/edit', $data);
}
 
public function update()
{
    $model = new NewsModel();
 
    $rules = [
        'body' => 'required',
        'title' => 'required'
    ];
    $id =  $this->request->getVar('id');
 
    if($this->validate($rules)){
        $fileImage_name = $this->request->getVar('oldFile');
        if(isset($_FILES) && @$_FILES['image_file']['error'] != '4') {
            if($fileImage = $this->request->getFile('image_file')) {
                if (! $fileImage->isValid()) {
                    throw new \RuntimeException($fileImage->getErrorString().'('.$fileImage->getError().')');
                } else {
                    $fileImage->move('images/news');
                    $fileImage_name = $fileImage->getName();
                }
            }
        }

        $data = [
            'body' => $this->request->getVar('body'),
            'title' => $this->request->getVar('title'),
            'publish_date'    => $this->request->getVar('publish_date'),
            'image' => $fileImage_name
        ];
         
        $model->update($id, $data);
 
        return redirect()->to(base_url('/news/list?page=1'));
 
    } else {
 
        $data['news'] = $model->getNews($id);
 
        $data['validation'] = $this->validator;
        $data['title'] = 'Update Berita';
        $data['menu'] = 'news';
        return view('news/edit', $data);
    }
}

public function delete()
{
    $model = new NewsModel();
    $model->where('id', $this->request->getVar('id'))->delete();
 
    return redirect()->to(base_url('/news/list?page=1'));
 
}
}