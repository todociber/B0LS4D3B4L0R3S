/**
 * Created by eacampos01 on 16/7/16.
 */


function animatedLoading() {

    waitingDialog.show('Procesando... ', {progressType: 'info'});
}
function submitForm(id) {
    console.log(id);

    $('#' + id).submit(function () {
        console.log('test');
        animatedLoading();
    });

}