<div class="mainContainer">
    <div class="containerMenu">
        <div class="contUser">
            <div class="userImg"></div>
            <p class="userName"><?=auth_getCurrentUser()["login"]?></p>
            <div class="btnSetting">Setting</div>
        </div>
        <ul class="mainMenu">
            <li class="line_menu" id="addConsult">
                <p>Add Consultation</p>
            </li>
            <li class="line_menu" id="consultList">
                <p>Consultation List</p>
            </li>
            <li class="line_menu" id="Exit">
                <p>Exit</p>
            </li>
        </ul>
    </div>
    <div class="containerContent">
        <div class="listContent">
            <form action="" id="addNewConsult" method="post" enctype="multipart/form-data">
                <div class="line_nameConsult">
                    <input id="dataConsult" value="22.05.2018" name="dataConsult" readonly>
                    <input id="timeConsult" value="12.30" name="timeConsult" readonly>
                </div>
                <div class="btnAdd btnVisitor">Add New Visitor</div>
                <div class="containerVisitors">
                    <div class="lineVisitor">
                        <p class="visitor">
                            <span >Vasiliy</span>
                            <span >Ivanov</span>
                        </p>
                        <p class="grupp">Eko-16</p>
                        <div class="btnDelVisitor">X</div>
                    </div>
                    <div class="lineVisitor">
                        <p class="visitor">
                            <span >Vasiliy</span>
                            <span >Ivanov</span>
                        </p>
                        <p class="grupp">Eko-16</p>
                        <div class="btnDelVisitor">X</div>
                    </div>
                </div>
                <input type="submit" value="Create" class="btnAdd" id="addFormConsult">
            </form>
        </div>
    </div>
</div>

<div class="container_form  newVisit">
    <h2>Add New Visitor</h2>
    <div class="btn addStudent"><span class="btnAdd">Add New Student</span></div>
    <form action=""  method="post" enctype="multipart/form-data">
        <div class="formLine">
            <select name="grupp" class="grVisitior" label="grupp">
                <option value="EKO-16">EKO-16</option>
                <option value="EKO-17">EKO-17</option>
            </select>
        </div>
        <div class="formLine">
            <select name="student" id="nameVisitor" >
                <option value="Vasiliy Ivanov">Vasiliy Ivanov</option>
                <option value="Vasiliy Ivanov">Vasiliy Ivanov</option>
            </select>
        </div>
        <div class="lineBtn">
            <div class="btn">
                <div class="btnCans"><span class="btnAdd">Back</span></div>
            </div>
            <div class="btn">
                <input type="submit" value="OK" id="addVis">
            </div>
        </div>
    </form>
</div>


<div class="container_form  newStudent">
    <h2>Create New Student</h2>
    <div class="btn addGrupp"><span class="btnAdd">Add New Grupp</span></div>
    <form action="addNewStudent"  method="post" enctype="multipart/form-data">
        <div class="formLine">
            <select name="group" class="grVisitior" label="grupp">
                <option value="1528139014236">EKO-15</option>
                <option value="1528140453386">TR</option>
            </select>
        </div>
        <div class="formLine">
            <input type="text" name="name" placeholder="First name">
        </div>
        <div class="formLine">
            <input type="text" name="surname" placeholder="Last name">
        </div>
        <div class="lineBtn">
            <div class="btn">
                <div class="btnCans"><span class="btnAdd">Back</span></div>
            </div>
            <div class="btn">
                <input type="submit" value="OK" id="addStud">
            </div>
        </div>
    </form>
</div>


<div class="container_form  newGrupp">
    <h2>Create New Grupp</h2>
    <form action="addNewGroup"  method="post" enctype="multipart/form-data">
        <div class="formLine">
            <input type="text" name="grupName" placeholder="Name grupp">
        </div>
        <div class="lineBtn">
            <div class="btn">
                <div class="btnCans"><span class="btnAdd">Back</span></div>
            </div>
            <div class="btn">
                <input type="submit" value="OK" id="addGrup">
            </div>
        </div>
    </form>
</div>