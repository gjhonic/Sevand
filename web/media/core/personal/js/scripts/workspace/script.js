//Переключает отображение блоков
function showBlock(block) {
    if(block === 'tasks') {
        $("#button-show-branches").css('display', 'inline-block');
        $("#button-show-tasks").css('display', 'none');

        $("#block-tasks").css('display', 'block');
        $("#block-branches").css('display', 'none');
    } else if(block === 'branches') {
        $("#button-show-branches").css('display', 'none');
        $("#button-show-tasks").css('display', 'inline-block');

        $("#block-tasks").css('display', 'none');
        $("#block-branches").css('display', 'block');
    }
}

function startLoad(){
    panelWarning(true, 'Идет загрузка, пж погодь...');
}

function endLoad(){
    panelWarning(false);
}

//Отвечает за панельку успех
function panelSuccess(mode, text = '') {
    if(mode == true) {
        $("#panel-success").html(text + getСross("#panel-success"));
        $("#panel-success").css('display', 'block');
    } else {
        $("#panel-success").html();
        $("#panel-success").css('display', 'none');
    }
}

//Отвечает за панельку внимание
function panelWarning(mode, text = '') {
    if(mode == true) {
        $("#panel-warning").html(text + getСross("#panel-warning"));
        $("#panel-warning").css('display', 'block');
    } else {
        $("#panel-warning").html();
        $("#panel-warning").css('display', 'none');
    }
}

//Отвечает за панельку опасность
function panelDanger(mode, text = '') {
    if(mode == true) {
        $("#panel-danger").html(text + getСross("#panel-danger"));
        $("#panel-danger").css('display', 'block');
    } else {
        $("#panel-danger").html();
        $("#panel-danger").css('display', 'none');
    }
}

//Дописывает крестик к панелям
function getСross(IdElem) {
    return "<span onclick='shutPanel(\"" + IdElem +"\")' class='crossik'>x</span>"
}

//Закрывает панель
function shutPanel(IdElem){
    $(IdElem).html();
    $(IdElem).css('display', 'none');
}