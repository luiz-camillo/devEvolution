<?php
namespace App\Curso\Task;

class Task
{
    public ?int $id;          
    public string $nome;
    public string $descricao;
    public string $prioridade;

    public function __construct(string $nome, string $descricao, string $prioridade, int $id = null)
    {
        $this->id         = $id;
        $this->nome       = $nome;
        $this->descricao  = $descricao;
        $this->prioridade = $prioridade;
    }
}
