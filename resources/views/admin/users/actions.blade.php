<div class="flex space-x-1">
    {{-- Botón Editar --}}
    <a href="{{ route('admin.users.edit', $row->id) }}" class="btn btn-sm btn-primary">
        <i class="fas fa-edit"></i>
    </a>

    {{-- Botón Eliminar (Ejemplo simple) --}}
    <form action="{{ route('admin.users.destroy', $row->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>
