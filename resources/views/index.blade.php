<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Livres</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .book-image {
            width: 100px;
            height: 150px;
            object-fit: cover;
            border-radius: 4px;
        }
        .action-buttons {
            white-space: nowrap;
        }
        .table-responsive {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>


<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-4"><i class="fas fa-book-open me-2"></i>Gestion des Livres</h1>
        
        <a href="{{ route('livres.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i> Ajouter un Livre
        </a>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <form action="{{ route('livres.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher par titre ou description..." 
                           value="{{ $search ?? '' }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Rechercher
                    </button>
                    @if(request()->has('search') && request()->search != '')
                        <a href="{{ route('livres.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Effacer
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Titre</th>
                            <th>Pages</th>
                            <th>Catégorie</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($livres as $livre)
                        <tr>
                            <td>{{ $livre->titre }}</td>
                            <td>{{ $livre->pages }}</td>
                            <td>
                                <span class="badge bg-info">{{ $livre->categorie->nom }}</span>
                            </td>
                            <td>
    @if ($livre->image)
    <img src="{{ asset('storage/' . $livre->image) }}" alt="Book cover" style="width: 100px; height: 150px; object-fit: cover; border-radius: 4px;">
       @else
      <p> Pas d'image</p> 
    @endif
</td>
                            <td class="action-buttons">
                                <a href="{{ route('livres.show', $livre->id) }}" class="btn btn-sm btn-info" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('livres.edit', $livre->id) }}" class="btn btn-sm btn-primary" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Aucun livre trouvé.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($livres->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $livres->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JavaScript -->
<script>
    // Confirmation for delete action
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if(confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')) {
                this.submit();
            }
        });
    });

    // Auto-dismiss alerts after 5 seconds
    window.setTimeout(function() {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
</script>
</body>
</html>