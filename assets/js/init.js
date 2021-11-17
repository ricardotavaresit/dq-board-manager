//===================== VARIAVEIS GLOBAIS =================
var myLayout, myLayout2 = null;
var myWins = null;
var myToolbar = null;
var myToolbar2 = null;
var myGrid = null;
var myGrid2 = null;
var myMenu = null;
var statusBar = null;
var myFormPesquisar = null;
var myForm = null;
var myTabbar = null;
var permissoes = null;

var mexeu_botoes = 0; 


var myGrid2A 	= null;
var myGrid2B 	= null;
var myGrid3A	= null;
var myToolbar2A = null;
var myToolbar2B = null;
var myToolbar2C = null;
var myToolbar3A = null;
var myLayout3 	= null;

window.dhx.skin = 'dhx_web'; //default skin

 
hs.graphicsDir = 'assets/js/highslide/graphics/';
hs.outlineType = 'rounded-white';
 
 

// ================ DEFINICÇÂO DE CALENDRAIO EM PT =================================
dhtmlXCalendarObject.prototype.langData["pt"] = {
	dateformat: '%Y.%m.%d',
	monthesFNames: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
	monthesSNames: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
	daysFNames: ["Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sabado"],
	daysSNames: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
	weekstart: 1,
	weekname: "S",
	today: "Hoje",
	clear: "Apagar"
};
dhtmlXCalendarObject.prototype.lang = "pt";




function doOnLoad() {
	
	checkSession(function () {

		if (myLayout != null) {
			myLayout.unload(); //para o caso de andar a navegar pelo menu, quando carrego no dashboard chamo a funcao doOnLoad e o layout já existe, entao destroi-se
			//var $jq = jQuery.noConflict();
			//$jq(document.body).empty();//limpa o conteudo do body
			document.body.innerHTML = "";
			
		}

		myLayout = null;
		myLayout2 = null;
		myWins = null;
		myToolbar = null;
		myToolbar2 = null;
		myGrid = null;
		myGrid2 = null;
		myMenu = null;
		statusBar = null;
		myFormPesquisar = null;
		myForm = null;
		myTabbar = null;
		permissoes = null;
		mexeu_botoes = 0;

		// ================= LAYOUT =================
		myLayout = new dhtmlXLayoutObject({
				parent: document.body,
				pattern: "1C",
				cells: [{
						id: "a",
						header: true,
						collapse: false
					}
				]
			});

		// ================= SET LAYOUT TEXT =================
		myLayout.cells("a").setText("Gestão Painel");

		// ================= CREATE WINDOWS =================

		myWins = new dhtmlXWindows({
				image_path: "./imgs/"
			});
			
		myWins.attachEvent("onFocus", function(win){
			if(window.dhx.isFF){
				var dim = win.getDimension(); // returns [w,h]
				win.setDimension(dim[0], dim[1]+60);
			}
		});

		// ================= MENU =================
	 	menu();

	});
}