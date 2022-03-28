<form action="{{ route('admin.dishes.destroy', $dish) }}" method="post" enctype='multipart/form-data'>
    {{method_field('delete')}}
    {{csrf_field()}}
    <div class="modal fade" id="ModalDelete{{$dish->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Sei sicuro di voler eliminare {{$dish->name}}?
                    </h4>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">
                        {{__('Annulla')}}
                    </button>
                    <button class="btn btn-danger" type="submit">
                        {{__('Elimina')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
