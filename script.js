
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
        page.addConsult.show();

    }

};
page.addConsult={
    init:function () {
        this.container=document.querySelector("#addNewConsult");
        this.btnAddVisitor=this.container.querySelector(".btnVisitor");
        this.containerVisitors=this.container.querySelector(".containerVisitors");
        this.lineName=this.container.querySelector(".line_nameConsult");
        this.btnDelVisitor=this.container.querySelector(".btnDelVisitor");
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
        page.formVisitor.init();
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
            btn.className="btnDelVisitor";
            lineVisitor.appendChild(p);
            lineVisitor.appendChild(group);
            lineVisitor.appendChild(btn);
            this.containerVisitors.appendChild(lineVisitor)
        }.bind(this));
    },
    deleteVisitor:function (e) {
        if(e.target.matches(".btnDelVisitor")){
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
        this.bindEvent();
        this.loadGroups();
        
    },
    bindEvent:function () {
        this.btnBack.addEventListener("click", this.hide.bind(this));
        this.btnAddNewStudent.addEventListener("click", this.showFormStudent.bind(this));
        this.groupSelect.addEventListener("change", this.loadStudents.bind(this));
        this.btnAdd.addEventListener("click", this.addVisitor.bind(this));
    },
    hide:function () {
        this.container.style.display="none";
    },
    show:function () {
        this.container.style.display="block";
    },
    showFormStudent:function () {
        page.formStudent.init();
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
        // console.log(response);
        if(response==="yes"){
            page.addConsult.loadVisitors();
            this.hide();
        }else{
            // alert ("Поле имени студента не может быть пустым");
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
        this.bindEvent();
        this.loadGroups();

    },
    bindEvent:function () {
        this.btnBack.addEventListener("click", this.hide.bind(this));
        this.btnAddNewGrupp.addEventListener("click", this.showFormGrupp.bind(this));
        this.btnAdd.addEventListener("click", this.createStudent.bind(this));
    },
    hide:function () {
        this.container.style.display="none";
    },
    show:function () {
        this.container.style.display="block";
    },
    showFormGrupp:function () {
        page.formGrupp.init();
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
        this.bindEvent();
    },
    bindEvent:function () {
        this.btnBack.addEventListener("click", this.hide.bind(this));
        this.btnAdd.addEventListener("click", this.addGroup.bind(this));

    },
    hide:function () {
        this.container.style.display="none";
    },
    show:function () {
        this.container.style.display="block";
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



window.addEventListener("load", page.init.bind(page));

