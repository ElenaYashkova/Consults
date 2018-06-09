
var AJAX={
    post:function (url, params, callback, onerror) {
        var xhr=new XMLHttpRequest();
        xhr.open("POST", url, true);
        var data=new FormData();
        for(var key in params) data.append(key,params[key]);
        xhr.onreadystatechange = function () {
            if(xhr.readyState!== 4) return;
            if(xhr.status===200) callback(xhr.responseText);
            else if(onerror) onerror();
        };
        xhr.send(data);
    },
    get:function (url,callback,onerror) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function () {
            if(xhr.readyState!==4) return;
            if (xhr.status === 200) {
                callback(xhr.responseText);
            } else if(onerror) onerror();
        };
        xhr.send();
    }
};


var page ={
    init:function () {
       // this.formGrupp.init();
       // this.formStudent.init();
       // this.formVisitor.init();
       // this.addConsult.init();
        this.mainMenu.init()
    }
};
page.mainMenu={
    init:function () {
        this.container=document.querySelector(".containerMenu");
        this.btnAddConsult=this.container.querySelector("#addConsult");
        this.bindEvent();

    },
    bindEvent:function () {
        this.btnAddConsult.addEventListener("click", this.onAddConsultClick.bind(this));
    },
    onAddConsultClick:function () {
        page.addConsult.init();
        page.formVisitor.init();
        page.addConsult.show();

    }

};
page.addConsult={
    init:function () {
        this.container=document.querySelector("#addNewConsult");
        this.btnAddVisitor=this.container.querySelector(".btnVisitor");
        this.containerVisitirs=this.container.querySelector(".containerVisitors");
        this.lineName=this.container.querySelector(".line_nameConsult");
        this.bindEvent();
        this.toOpenConsult();
    },
    bindEvent:function () {
        this.btnAddVisitor.addEventListener("click",this.showFormVisitor.bind(this))
    },
    showFormVisitor:function () {
        page.formVisitor.show();

    },
    show:function () {
        this.container.style.display="block";
    },
    hide:function () {
        this.container.style.display="none";
    },
    toOpenConsult:function () {
        //todo ajax get consult
        AJAX.get("/PROGECT/Consults/openConsult",this.consultOpened.bind(this))
    },
    consultOpened:function (response) {
        var consult=JSON.parse(response);
        var name=consult["name"].split("_");
        this.container.setAttribute("data-class", consult["id"]);
        var nameDate=document.createElement("p");
        nameDate.setAttribute("class","nameConsult");
        nameDate.innerText=name[0];
        var nameTime=document.createElement("p");
        nameTime.setAttribute("class","nameConsult");
        nameTime.innerText=name[1];
        this.lineName.appendChild(nameDate);
        this.lineName.appendChild(nameTime);
        AJAX.post("/PROGECT/Consults/getAllConsultVisitors",{consult_id:consult["id"]},this.loadVisitors.bind(this))
    },
    loadVisitors:function (data) {
        var students=JSON.parse(data);

        //create line visitor
        this.containerVisitirs.innerHTML="";
        students.forEach(function (student) {
            var lineVisitor=document.createElement("div");
            lineVisitor.className="lineVisitor";
            lineVisitor.setAttribute("data-class",student["id"]);

            var p=document.createElement("p");
            p.className="visitor";
            var spanSurname=document.createElement("span");
            spanSurname.innerText=student["surname"];
            var spanName=document.createElement("span");
            spanName.innerText=student["name"];
            p.appendChild(spanName);
            p.appendChild(spanName);

            var group=document.createElement("p");
            group.className="grupp";
            group.innerText=student["group_name"];

            var btn=document.createElement("div");
            btn.className="btnDelVisitor";
            lineVisitor.appendChild(p);
            lineVisitor.appendChild(group);
            lineVisitor.appendChild(btn);
            this.containerVisitirs.appendChild(lineVisitor)
        }.bind(this));
        //------------------
    }


};


page.formVisitor={
    init:function () {
        this.container=document.querySelector(".newVisit");
        this.btnAddNewStudent=this.container.querySelector(".addStudent");
        this.btnBack=this.container.querySelector(".btnCans");
        this.btnAdd=this.container.querySelector("#addVis");
        this.groupSelect=this.container.querySelector(".grVisitior");
        this.studentSelect=this.container.querySelector("#nameVisitor");
        this.bindEvent();
        this.loadGroups();
        
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
    },
    loadGroups:function () {
        AJAX.get("/PROGECT/Consults/getAllGroups",this.onLoadedGroups.bind(this))
    },
    loadStudents:function () {
        this.studentSelect.innerHTML="";
        if(this.groupSelect.disabled=true) return;
        var group_id=this.groupSelect.value;
        AJAX.post()
    },
    onLoadedStudents:function () {

    },
    onLoadedGroups:function (data) {
        // console.log(data);

        var groups=JSON.parse(data);
        this.groupSelect.innerHTML="";
        groups.forEach(function (group) {
           var option=document.createElement("option");
           option.setAttribute("value",group["id"]);
           option.innerText=group["name"];
           this.groupSelect.appendChild(option);
        }.bind(this));
        if(groups.length > 0){
            this.groupSelect.disabled=false;
            //todo load students

        } else {
            this.groupSelect.disabled = true
        }
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
        this.btnAdd=this.container.querySelector("#addGrup");
        this.bindEvent();
    },
    bindEvent:function () {
        this.btnBack.addEventListener("click", this.hide.bind(this));
        this.btnAdd.addEventListener("click", this.hide.bind(this));

    },
    hide:function () {
        this.container.style.display="none";
    },
    show:function () {
        this.container.style.display="block";
    }
};



window.addEventListener("load", page.init.bind(page));

