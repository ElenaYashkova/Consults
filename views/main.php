<script type="text/javascript" src="/PROGECT/Consults/script.js"></script>

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
                <a href="logout">Exit</a>
            </li>
        </ul>
    </div>
    <div class="containerContent">
        <div class="listContent">
            <form action="" id="addNewConsult" method="post" enctype="multipart/form-data">
                <div class="line_nameConsult"></div>
                <div class="btnAdd btnVisitor">Add New Visitor</div>
                <div class="containerVisitors">
                    <div class="decoWait"></div>
                </div>
                <input type="submit" value="Create" class="btnAdd" id="addFormConsult">
            </form>
            <div class="containerUserConsults">
                <h3>All user <?=auth_getCurrentUser()["login"]?> consults</h3>
                <div class="wrapConsults">
                    <div class="lineConsult">
                        <p class="nameConsult">Date</p>
                        <div class="wrapBtn">
                            <div class="del">del</div>
                            <div class="more">more</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="containerConsultInfo">
                <div class="line_nameConsult">
<!--                    <p class="nameConsult">12.06.2018</p>-->
<!--                    <p class="nameConsult">18:29</p>-->
                </div>
                <h3>List of Students</h3>
                <div class="containerVisitors">
<!--                    <div class="lineInfo">-->
<!--                        <p class="visitor">-->
<!--                            <span>Sonya</span>-->
<!--                            <span> Sotnick</span>-->
<!--                        </p>-->
<!--                        <p class="grupp">EKO-15</p>-->
<!--                    </div>-->
                </div>
                <p class="btnAdd">Close</p>
            </div>
        </div>
    </div>
</div>

<div class="container_form  newVisit">
    <h2>Add New Visitor</h2>
    <div class="btn addStudent"><span class="btnAdd">Add New Student</span></div>
    <div class="wrap">
        <div class="formLine">
            <select name="group" class="grVisitior" label="grupp" disabled>
                <option value="1528139014236">EKO-15</option>
                <option value="1528140453386">TR</option>
            </select>
        </div>
        <div class="formLine">
            <select name="student" id="nameVisitor" disabled>
                <option value="1528147490_1819">Sonya Sotnick</option>
                <option value="1528193162_49">Toma Sotnick</option>
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
    </div>
</div>


<div class="container_form  newStudent">
    <h2>Create New Student</h2>
    <div class="btn addGrupp"><span class="btnAdd">Add New Grupp</span></div>
    <div class="wrap">
        <div class="formLine">
            <select name="group" class="grVisitior" label="grupp" disabled>
<!--                <option value="1528139014236">EKO-15</option>-->
<!--                <option value="1528140453386">TR</option>-->
            </select>
        </div>
        <div class="formLine">
            <input type="text" name="name" placeholder="First name" id="F_name">
        </div>
        <div class="formLine">
            <input type="text" name="surname" placeholder="Last name" id="L_name">
        </div>
        <div class="lineBtn">
            <div class="btn">
                <div class="btnCans"><span class="btnAdd">Back</span></div>
            </div>
            <div class="btn">
                <input type="submit" value="OK" id="addStud">
            </div>
        </div>
    </div>
</div>


<div class="container_form  newGrupp">
    <h2>Create New Grupp</h2>
    <div class="wrap">
        <div class="formLine">
            <input type="text" name="grupName" placeholder="Name grupp" id="groupName">
        </div>
        <div class="lineBtn">
            <div class="btn">
                <div class="btnCans"><span class="btnAdd">Back</span></div>
            </div>
            <div class="btn">
                <input type="submit" value="OK" id="addGrup">
            </div>
        </div>
    </div>
</div>