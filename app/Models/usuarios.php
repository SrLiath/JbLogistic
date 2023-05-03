<?php namespace App\Models;

use CodeIgniter\Model;

class usuarios extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description'];

    public function getSubjectById($id)
    {
        return $this->find($id);
    }

    public function getAllSubjects()
    {
        return $this->findAll();
    }

    public function insertSubject($data)
    {
        return $this->insert($data);
    }

    public function updateSubject($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteSubject($id)
    {
        return $this->delete($id);
    }
}
