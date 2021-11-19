var w1;
function board_manager_permissions(menu) {

	init_permissions(menu); 

	toolbar_permissions(menu);

	grid_permissions(menu);

}

function init_permissions(menu){

	//myLayout.progressOn();

	var hearder_text = "Board Manager - Permissions - ";
	switch (menu) {
		case 1:
			hearder_text += "Banner Qualidade";
			break;
		default:
			break;
	}
	myLayout.cells("a").setText(hearder_text);
}


function toolbar_permissions(menu) {

	if (myToolbar2 != null){
		myLayout.cells("a").detachToolbar();
	}

	myToolbar2 = null;
	myToolbar2 = myLayout.cells("a").attachToolbar();
	myToolbar2.setIconset("awesome");
	myToolbar2.addButton("add", 10, "Add", "fa fa-file");
	myToolbar2.addButton("delete", 30, "Delete", "fa fa-trash");

	myToolbar2.attachEvent("onClick", function (id) {

		const bannerId = myGrid.getSelectedRowId();
	
		if (id == 'add') {
			windows_add_user(menu);
		}else if (id == 'delete') {
			if (bannerId){
				delete_user(menu); 
			}else{
				error("You must select a line to delete");
			}
		}
	});
}


function grid_permissions(menu){

	if (myGrid != null){
		myLayout.cells("a").detachObject(true);
	}

	myGrid = null;
	myGrid = myLayout.cells("a").attachGrid();
	myGrid.setImagePath("./assets/images/icons/");
	myGrid.setStyle("text-align:center;vertical-align: middle !important;", "", "", "background-color:#C0D6E4");

	myGrid.attachEvent("onXLE", function (grid_obj, count) {
		myLayout.progressOff();
	});

	myGrid.attachEvent("onCheckbox", function (rowId, cellInd, state) {
		window.dhx4.ajax.get("permissions/actions/change.php?id=" + rowId + "&cell=" + cellInd + "&menu=" + menu);
	});
 
	myGrid.init();
	myGrid.load(`./permissions/data/grid_permissions${menu}.php`);
}

function windows_add_user( menu ) {

	if (!myWins.window("w1")) {
		w1 = myWins.createWindow("w1", 150, 10, 400, 180);
		myWins.window("w1").setText(`Add User`);
		myWins.window("w1").centerOnScreen();
		myWins.window("w1").denyResize();
		myWins.window("w1").denyMove();
		myWins.window("w1").button("park").disable();
		myWins.window("w1").setModal(true);
		myWins.window("w1").progressOn();

		toobar_add_user( menu ); 
		form_add_user( menu ); 
	}
}


function toobar_add_user( menu ) {

	if (myToolbar3 != null){
		w1.detachToolbar();
	}

	myToolbar3 = null;
	myToolbar3 = w1.attachToolbar();
	myToolbar3.setIconset("awesome");
	myToolbar3.addButton("back", 10, "Back", "fa fa-undo");
	myToolbar3.addSpacer("back");
	myToolbar3.addButton("save", 20, "Save", "fa fa-save");
 
	myToolbar3.attachEvent("onClick", function (id) {
		switch (id) {
		case 'back':
			w1.close();
			break;
		case 'save':
			save_add_user(menu);
			break;
		default:
			break;
		}
	});
}


function form_add_user(){
	myForm = null;
	myForm = w1.attachForm();
	myForm.loadStruct(`permissions/forms/form_add_user.php?menu=${menu}`);

	myForm.attachEvent("onXLE", function () {
		myForm.setFocusOnFirstActive();
		w1.progressOff();
	});

	myForm.attachEvent("onButtonClick", function ( name ) {
		if ( name == "bt_pesquisar" ) {
			_searchSelect("pesquisar", "id_user", myForm, "1");
		}
	});
}



function save_add_user(menu){
	if (myForm.validate()) {
		myForm.send(`permissions/actions/action_add_user.php?menu=${menu}`,  function ( response ) {

			const obj = window.dhx4.s2j(response.xmlDoc.responseText);
			if (  obj.status == 200) {
				myLayout.progressOn();
				myGrid.clearAndLoad(`./permissions/data/grid_permissions${menu}.php`, function(){
					myGrid.selectRowById(obj.msg);
				});
					w1.progressOff();
				w1.close();
			} else {
				error(obj.msg);
			} 
		});
	} else {
		error("Dados Inválidos");
	}
}



function delete_user( menu ) {

	var selId = myGrid.getSelectedRowId();
	if (selId) {
		dhtmlx.message({
			title: "Delete User",
			type: "confirm-warning",
			text: "Are you sure you want to delete this user?",
			id: "elimina_",
			callback: function (result) {
				if (result == true) {
					window.dhx4.ajax.post(`permissions/actions/action_delete_user.php?id=${selId}&menu=${menu}`, function ( response ) {
						
						const obj = window.dhx4.s2j(response.xmlDoc.responseText);
						if (  obj.status == 200) {
							myLayout.progressOn();
							myGrid.clearAndLoad(`./permissions/data/grid_permissions${menu}.php`, function(){

							}); 
						} else {
							error(obj.msg);
						}  
					});
				}
			}
		});
	} else {
		error("Select a line to delete!");
	}
}