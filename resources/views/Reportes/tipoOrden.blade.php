@if($orden->idTipoOrden == 1)
    <div class="col-xs-4 display-cell ">
        <input type="checkbox" checked> Compra

    </div>
    <div class="col-xs-4 display-cell ">

        <input type="checkbox" name="vehicle" value="Car"> Venta
    </div>
@else
    <div class="col-xs-4 display-cell ">
        <input type="checkbox"> Compra

    </div>
    <div class="col-xs-4 display-cell " checked>

        <input type="checkbox" name="vehicle" value="Car"> Venta
    </div>
@endif