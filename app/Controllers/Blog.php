<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

class Blog extends ResourceController
{
    protected $modelName = 'App\Models\BlogModel';
    protected $format = 'json';

    // Get all posts from database
    public function index(){
        $posts = $this->model->findAll();
        return $this->respond($posts);
    }

    // Create a post
    public function create(){
        helper(['form']);

        $rules = [
            'title' => 'required|min_length[6]',
            'description' => 'required'
        ];

        if (!$this->validate($rules)){
            return $this->fail($this->validator->getErrors());
        }
        else {
            $data = [
                'post_title' => $this->request->getVar('title'),
                'post_description' => $this->request->getVar('description'),
            ];

            $post_id = $this->model->insert($data);
            $data['post_id'] = $post_id;
            return $this->respondCreated($data);
        }
    }

    // get a specific post by the post_id
    public function show($postId = null)
    {
        $data = $this->model->find($postId);
        if ($data){
            return $this->respond($data);
        }
        else
        return $this->failNotFound('Post not found !');
    }

    // Update a post
    public function update($id = null){
        helper(['form']);

        $rules = [
            'title' => 'required|min_length[6]',
            'description' => 'required'
        ];

        if (!$this->validate($rules)){
            return $this->fail($this->validator->getErrors());
        }
        else{
            $input = $this->request->getRawInput();
            $data = [
                'post_id' => $id,
                'post_title' => $input['title'],
                'post_description' => $input['description']

            ];
            $this->model->save($data);
            return $this->respond($data);
        }
    }

    // Delete a post
    public function delete($id = null){
        $data = $this->model->find($id);
        if ($data){
            $this->model->delete($id);
            return $this->respondDeleted($data);
        }
        else{
            return $this->failNotFound('Item not found');
        }
    }
}
