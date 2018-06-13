
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
        this.formGrupp.init();
        this.formStudent.init();
        this.formVisitor.init();
        this.addConsult.init();
        this.mainMenu.init();
        this.userConsults.init();
        this.consultInfo.init();
    }
};
page.mainMenu={
    init:function () {
        this.container=document.querySelector(".containerMenu");
        this.btnAddConsult=this.container.querySelector("#addConsult");
        this.btnListConsults=this.container.querySelector("#consultList");
        this.bindEvent();

    },
    bindEvent:function () {
        this.btnAddConsult.addEventListener("click", this.onClickAddConsult.bind(this));
        this.btnListConsults.addEventListener("click",this.onClickListConsults.bind(this));
    },
    onClickAddConsult:function () {
        page.addConsult.show();
        page.consultInfo.hide();
        page.userConsults.hide();
    },
    onClickListConsults:function () {
        page.userConsults.show();
        page.addConsult.hide();
        page.consultInfo.hide();
    }

};
page.addConsult={
    init:function () {
        this.container=document.querySelector("#addNewConsult");
        this.btnAddVisitor=this.container.querySelector(".btnVisitor");
        this.containerVisitors=this.container.querySelector(".containerVisitors");
        this.lineName=this.container.querySelector(".line_nameConsult");
        this.btnClose=this.container.querySelector("#addFormConsult");
        this.bindEvent();
        this.toOpenConsult();
    },
    bindEvent:function () {
        this.btnAddVisitor.addEventListener("click",this.showFormVisitor.bind(this));
        this.containerVisitors.addEventListener("click", this.deleteVisitor.bind(this));
        this.btnClose.addEventListener("click",this.closeConsult.bind(this));
    },
    showFormVisitor:function () {
        page.formVisitor.show();
        page.formVisitor.btnAdd.setAttribute("data-class",this.container.getAttribute("data-class"));

    },
    show:function () {
        this.container.style.display="block";
    },
    hide:function () {
        this.container.style.display="none";
    },
    toOpenConsult:function () {
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
        this.loadVisitors();
    },
    loadVisitors:function(){
        var consult_id=this.container.getAttribute("data-class");
        AJAX.post("/PROGECT/Consults/getAllConsultVisitors",{consult_id:consult_id},this.onLoadedVisitors.bind(this))
    },
    onLoadedVisitors:function (data) {
        var students=JSON.parse(data);
        this.containerVisitors.innerHTML="";
        if(students.length==0){
            var deco=document.createElement("div");
            deco.className="decoWait";
            this.containerVisitors.appendChild(deco);
            deco.style.display="block";
        }else{
            students.forEach(function (student) {
                var lineVisitor=document.createElement("div");
                lineVisitor.className="lineVisitor";
                lineVisitor.setAttribute("data-class",student["id"]);
                var p=document.createElement("p");
                p.className="visitor";
                var spanSurname=document.createElement("span");
                spanSurname.innerText=" "+student["surname"];
                var spanName=document.createElement("span");
                spanName.innerText=student["name"];
                p.appendChild(spanName);
                p.appendChild(spanSurname);
                var group=document.createElement("p");
                group.className="grupp";
                group.innerText=student["group_name"];
                var btn=document.createElement("div");
                btn.className="del";
                lineVisitor.appendChild(p);
                lineVisitor.appendChild(group);
                lineVisitor.appendChild(btn);
                this.containerVisitors.appendChild(lineVisitor)
            }.bind(this));
        }

    },
    deleteVisitor:function (e) {
        if(e.target.matches(".del")){
            var consult_id=e.target.closest("#addNewConsult").getAttribute("data-class");
            var student_id=e.target.closest(".lineVisitor").getAttribute("data-class");
            AJAX.post("/PROGECT/Consults/delVisitor",{consult_id:consult_id, student_id:student_id}, this.onDeletedVisitor.bind(this));
        }
    },
    onDeletedVisitor:function (response) {
        if(response==="yes"){
            page.addConsult.loadVisitors();
        }else{
            alert ("error");
        }
    },
    closeConsult:function () {
        var id=this.container.getAttribute("data-class");
        AJAX.post("/PROGECT/Consults/closeConsult", {id:id});
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
        this.shadow=document.querySelector("#newVisit");
        this.bindEvent();

        
    },
    bindEvent:function () {
        this.btnBack.addEventListener("click", this.hide.bind(this));
        this.btnAddNewStudent.addEventListener("click", this.showFormStudent.bind(this));
        this.groupSelect.addEventListener("change", this.loadStudents.bind(this));
        this.btnAdd.addEventListener("click", this.addVisitor.bind(this));
    },
    hide:function () {
        this.container.style.display="none";
        this.shadow.style.display="none";
    },
    show:function () {
        this.loadGroups();
        this.container.style.display="block";
        this.shadow.style.display="block";
    },
    showFormStudent:function () {
        page.formStudent.show();
    },
    loadStudents:function () {
        if(this.groupSelect.disabled) return;
        var group_id=this.groupSelect.value;
        AJAX.post("/PROGECT/Consults/getAllStudByGroup", {group_id:group_id},this.onLoadedStudents.bind(this))
    },
    onLoadedStudents:function (data) {
        var students = JSON.parse(data);
        this.studentSelect.innerHTML=" ";
        students.forEach(function (student) {
            var option=document.createElement("option");
            option.setAttribute("value",student["id"]);
            option.innerText=student["name"]+" "+student["surname"];
            this.studentSelect.appendChild(option);
        }.bind(this));
        if(students.length>0){
            this.studentSelect.disabled=false;
        }else{
            this.studentSelect.disabled=true;
        };

    },
    loadGroups:function () {
        AJAX.get("/PROGECT/Consults/getAllGroups",this.onLoadedGroups.bind(this))
    },
    onLoadedGroups:function (data) {
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
            this.loadStudents();
        } else {
            this.groupSelect.disabled = true
        }
    },
    addVisitor:function () {
        var consult=this.btnAdd.getAttribute("data-class");
        var student=this.studentSelect.value;
        AJAX.post("/PROGECT/Consults/addNewVisitor", {student_id:student, consult_id:consult}, this.onAddedVisitor.bind(this))
    },
    onAddedVisitor:function (response) {
        if(response==="yes"){
            page.addConsult.loadVisitors();
            this.hide();
        }
        if(response==="exist") {
            alert ("this visitor exist");
            this.hide();
        }else{
            this.hide();
        }
    }


};



page.formStudent={
    init:function () {
        this.container=document.querySelector(".newStudent");
        this.btnAddNewGrupp=this.container.querySelector(".addGrupp");
        this.btnBack=this.container.querySelector(".btnCans");
        this.btnAdd=this.container.querySelector("#addStud");
        this.groupSelect=this.container.querySelector(".grVisitior");
        this.inputName=this.container.querySelector("#F_name");
        this.inputSurname=this.container.querySelector("#L_name");
        this.shadow=document.querySelector("#newStudent");
        this.bindEvent();

    },
    bindEvent:function () {
        this.btnBack.addEventListener("click", this.hide.bind(this));
        this.btnAddNewGrupp.addEventListener("click", this.showFormGrupp.bind(this));
        this.btnAdd.addEventListener("click", this.createStudent.bind(this));
    },
    hide:function () {
        this.container.style.display="none";
        this.shadow.style.display="none";
    },
    show:function () {
        this.container.style.display="block";
        this.shadow.style.display="block";
        this.loadGroups();
    },
    showFormGrupp:function () {
        page.formGrupp.show();
    },
    loadGroups:function () {
        AJAX.get("/PROGECT/Consults/getAllGroups",this.onLoadedGroups.bind(this))
    },
    onLoadedGroups:function (data) {
        var groups=JSON.parse(data);
        this.groupSelect.innerHTML="";
        groups.forEach(function (group) {
            var option=document.createElement("option");
            option.setAttribute("value",group["id"]);
            option.innerText=group["name"];
            this.groupSelect.appendChild(option);
        }.bind(this));
        if(groups.length > 0) this.groupSelect.disabled=false;
        else this.groupSelect.disabled = true;
    },
    createStudent:function () {
        var name=this.inputName.value;
        var surName=this.inputSurname.value;
        var group=this.groupSelect.value;
        AJAX.post("/PROGECT/Consults/addNewStudent",{name:name, surname:surName, group:group},this.onCreatedStudent.bind(this))
    },
    onCreatedStudent:function (response) {
        if(response==="yes"){
            page.formVisitor.loadGroups();
            this.hide();
        }else{
            alert ("Заполните все поля");
            this.hide();
        }

    }
};
page.formGrupp={
    init:function () {
        this.container=document.querySelector(".newGrupp");
        this.btnBack=this.container.querySelector(".btnCans");
        this.inputName=this.container.querySelector("#groupName");
        this.btnAdd=this.container.querySelector("#addGrup");
        this.shadow=document.querySelector("#newGrupp");
        this.bindEvent();
    },
    bindEvent:function () {
        this.btnBack.addEventListener("click", this.hide.bind(this));
        this.btnAdd.addEventListener("click", this.addGroup.bind(this));

    },
    hide:function () {
        this.container.style.display="none";
        this.shadow.style.display="none";
    },
    show:function () {
        this.container.style.display="block";
        this.shadow.style.display="block";
    },
    addGroup:function () {
        var name=this.inputName.value;
        AJAX.post("/PROGECT/Consults/addNewGroup",{name:name},this.onAddedGroup.bind(this));
    },
    onAddedGroup:function (response) {
        if(response==="yes"){
            page.formStudent.loadGroups();
            this.hide();
        }else{
            alert ("Пол");
            this.hide();
        }
    }
};
page.userConsults={
    init:function () {
        this.container=document.querySelector(".containerUserConsults");
        this.consultsBlock=this.container.querySelector(".wrapConsults");
        this.bindEvent();
    },
    bindEvent:function (){
        this.consultsBlock.addEventListener("click", this.chooseEvent.bind(this));
    },
    show:function () {
        this.container.style.display="block";
        this.update();
    },
    hide:function () {
        this.container.style.display="none";
    },
    update:function () {
        AJAX.get("/PROGECT/Consults/getAllByUser", this.loadConsults.bind(this));
    },
    loadConsults:function (data) {
        var consults=JSON.parse(data);
        this.consultsBlock.innerHTML="";
        consults.forEach(function (consult) {
            var lineConsult=document.createElement("div");
            lineConsult.className="lineConsult";
            lineConsult.setAttribute("data-id", consult["id"]);
            var name=document.createElement("p");
            name.className="nameConsult";
            name.innerText=consult["name"];
            var wrapBtn=document.createElement("div");
            wrapBtn.className="wrapBtn";
            var del=document.createElement("div");
            del.className="del";
            var more=document.createElement("div");
            more.className="more";
            wrapBtn.appendChild(del);
            wrapBtn.appendChild(more);
            lineConsult.appendChild(name);
            lineConsult.appendChild(wrapBtn);
            this.consultsBlock.appendChild(lineConsult);
        }.bind(this));

    },
    chooseEvent:function (e) {
        if(e.target.matches(".del")){
            var id=e.target.closest(".lineConsult").dataset.id;
            this.deleteConsult(id);
        }
        if(e.target.matches(".more")){
            var id=e.target.closest(".lineConsult").dataset.id;
            this.gettingDetails(id)
        }
    },
    deleteConsult:function (id) {
        AJAX.post("/PROGECT/Consults/deleteConsult",{id:id},this.update.bind(this));
    },
    gettingDetails:function (id) {
        this.hide();
        page.consultInfo.show(id);
    }

};
page.consultInfo={
    init:function () {
        this.container=document.querySelector(".containerConsultInfo");
        this.lineName=this.container.querySelector(".line_nameConsult");
        this.containerVisitors=this.container.querySelector(".containerVisitors");
        this.btn=this.container.querySelector(".btnAdd");
        this.bindEvent();
    },
    bindEvent:function () {
        this.btn.addEventListener("click",this.hide.bind(this));
    },
    show:function (id) {
        this.toOpenInfo(id);
        this.container.style.display="block";
    },
    hide:function () {
        this.container.style.display="none";
        page.userConsults.show();
    },
    toOpenInfo:function (id) {
        AJAX.post("/PROGECT/Consults/getDetails",{id:id},this.openedInfo.bind(this));
    },
    openedInfo:function (data) {
        this.lineName.innerHTML="";
        var consult=JSON.parse(data);
        var name=consult["name"].split("_");
        var nameDate=document.createElement("p");
        nameDate.setAttribute("class","nameConsult");
        nameDate.innerText=name[0];
        var nameTime=document.createElement("p");
        nameTime.setAttribute("class","nameConsult");
        nameTime.innerText=name[1];
        this.lineName.appendChild(nameDate);
        this.lineName.appendChild(nameTime);
        this.loadVisitors(consult["id"]);
    },
    loadVisitors:function (id) {
        AJAX.post("/PROGECT/Consults/getAllConsultVisitors",{consult_id:id},this.onLoadedVisitors.bind(this));
    },
    onLoadedVisitors:function (data) {
        var students=JSON.parse(data);
        this.containerVisitors.innerHTML="";
        students.forEach(function (student) {
            var lineVisitor=document.createElement("div");
            lineVisitor.className="lineInfo";
            var p=document.createElement("p");
            p.className="visitor";
            var spanSurname=document.createElement("span");
            spanSurname.innerText=" "+student["surname"];
            var spanName=document.createElement("span");
            spanName.innerText=student["name"];
            p.appendChild(spanName);
            p.appendChild(spanSurname);
            var group=document.createElement("p");
            group.className="grupp";
            group.innerText=student["group_name"];
            lineVisitor.appendChild(p);
            lineVisitor.appendChild(group);
            this.containerVisitors.appendChild(lineVisitor)
        }.bind(this));
    }

};

window.addEventListener("load", page.init.bind(page));

