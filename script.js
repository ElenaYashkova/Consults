

var page ={
    init:function () {
       this.formGrupp.init();
       this.formStudent.init();
       this.formVisitor.init();
       this.addConsult.init();
    }
};
page.mainMenu={
};
page.addConsult={
    init:function () {
        this.container=document.querySelector(".listContent");
        this.btnAddVisitor=this.container.querySelector(".btnVisitor");
        this.bindEvent();
    },
    bindEvent:function () {
        this.btnAddVisitor.addEventListener("click",this.showFormVisitor.bind(this))
    },
    showFormVisitor:function () {
        page.formVisitor.show();
    }
};
page.formVisitor={
    init:function () {
        this.container=document.querySelector(".newVisit");
        this.btnAddNewStudent=this.container.querySelector(".addStudent");
        this.btnBack=this.container.querySelector(".btnCans");
        this.bindEvent();
    },
    bindEvent:function () {
        this.btnBack.addEventListener("click", this.hide.bind(this));
        this.btnAddNewStudent.addEventListener("click", this.showFormStudent.bind(this))
    },
    hide:function () {
        this.container.style.display="none";
    },
    show:function () {
        this.container.style.display="block";
    },
    showFormStudent:function () {
        page.formStudent.show();
    }
};
page.formStudent={
    init:function () {
        this.container=document.querySelector(".newStudent");
        this.btnAddNewGrupp=this.container.querySelector(".addGrupp");
        this.btnBack=this.container.querySelector(".btnCans");
        this.bindEvent();

    },
    bindEvent:function () {
        this.btnBack.addEventListener("click", this.hide.bind(this));
        this.btnAddNewGrupp.addEventListener("click", this.showFormGrupp.bind(this))
    },
    hide:function () {
        this.container.style.display="none";
    },
    show:function () {
        this.container.style.display="block";
    },
    showFormGrupp:function () {
        page.formGrupp.show();
    }
};
page.formGrupp={
    init:function () {
        this.container=document.querySelector(".newGrupp");
        this.btnBack=this.container.querySelector(".btnCans");
        this.bindEvent();
    },
    bindEvent:function () {
        this.btnBack.addEventListener("click", this.hide.bind(this));
        
    },
    hide:function () {
        this.container.style.display="none";
    },
    show:function () {
        this.container.style.display="block";
    }
};



window.addEventListener("load", page.init.bind(page));

