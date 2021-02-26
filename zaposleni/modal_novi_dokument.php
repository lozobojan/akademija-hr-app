<div class="modal fade" id="modal_novi_dokument">
    <div class="modal-dialog">
    <form action="./dodaj_dokument.php" method="POST" enctype="multipart/form-data" >
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Novi dokument</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            
                    <input type="hidden" name="radnik_id" value="<?=$id?>">
                    <div class="row mt-2">
                        <div class="col-12">
                            <input type="text" class="form-control" name="naziv" placeholder="Unesite naziv" >
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <select name="tip_dokumenta_id" class="form-control" id="">
                                <option value="">- odaberite tip dokumenta -</option>
                                <?php sifarnik('tip_dokumenta'); ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <input type="date" class="form-control" name="datum" >
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <textarea name="napomena" id="" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <input type="file" class="form-control" name="dokument" >
                        </div>
                    </div>
                

            </div>
            <div class="modal-footer justify-content-between">
            <a type="button" class="btn btn-default" data-dismiss="modal">Odustani</a>
            <button type="submit" class="btn btn-primary">Potvrdi</button>
            </div>
        </div>
    </form>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->