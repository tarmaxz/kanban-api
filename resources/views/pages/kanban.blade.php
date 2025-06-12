@extends('template.master')

@section('content')
<div class="container-fluid py-4">
    <h2 class="text-center mb-5">Meus Quadros de Kanban</h2>

    <!-- Quadro 1 -->
    <div class="board-section">
      <div class="board-title">Projeto App</div>
      <div class="kanban-board">
        <!-- Categoria 1 -->
        <div class="kanban-column bg-light p-3 rounded">
          <div class="column-header">To Do</div>
          <div class="kanban-card">Criar tela de login</div>
          <div class="kanban-card">Definir esquema de cores</div>
        </div>
        <!-- Categoria 2 -->
        <div class="kanban-column bg-light p-3 rounded">
          <div class="column-header">Doing</div>
          <div class="kanban-card">Desenvolvendo dashboard</div>
        </div>
        <!-- Categoria 3 -->
        <div class="kanban-column bg-light p-3 rounded">
          <div class="column-header">Done</div>
          <div class="kanban-card">Configuração inicial do projeto</div>
        </div>

        <div class="kanban-column bg-light p-3 rounded">
            <div class="column-header">Done</div>
            <div class="kanban-card">Configuração inicial do projeto</div>
          </div>

          <div class="kanban-column bg-light p-3 rounded">
            <div class="column-header">Done</div>
            <div class="kanban-card">Configuração inicial do projeto</div>
          </div>

          <div class="kanban-column bg-light p-3 rounded">
            <div class="column-header">Done</div>
            <div class="kanban-card">Configuração inicial do projeto</div>
          </div>

          <div class="kanban-column bg-light p-3 rounded">
            <div class="column-header">Done</div>
            <div class="kanban-card">Configuração inicial do projeto</div>
          </div>

          <div class="kanban-column bg-light p-3 rounded">
            <div class="column-header">Done</div>
            <div class="kanban-card">Configuração inicial do projeto</div>
          </div>
      </div>
    </div>

    <!-- Quadro 2 -->
    <div class="board-section">
      <div class="board-title">Estudos</div>
      <div class="kanban-board">
        <div class="kanban-column bg-light p-3 rounded">
          <div class="column-header">Planejado</div>
          <div class="kanban-card">Estudar Bootstrap</div>
        </div>
        <div class="kanban-column bg-light p-3 rounded">
          <div class="column-header">Em andamento</div>
          <div class="kanban-card">Curso React.js</div>
        </div>
        <div class="kanban-column bg-light p-3 rounded">
          <div class="column-header">Finalizado</div>
          <div class="kanban-card">Revisar lógica de programação</div>
        </div>
      </div>
    </div>

  </div>
@endsection
