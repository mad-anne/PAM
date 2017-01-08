<h3>Pracownia architektoniczna <span id="subtitle">| dodaj projekt</span></h3>
<form class="form-horizontal" ng-submit="addProject()" name="addProjectForm" id="addProjectForm" enctype="multipart/form-data">
    <div class="form-group">
        <div class="row">
            <label for="name" class="col-sm-2 control-label">nazwa</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="name" maxlength="150" name="name" ng-model="name" ng-value="current.name" required>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <span class="col-sm-10 error" id="nameErr" ng-show="addProjectForm.name.$error.required">nazwa jest wymagana</span>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label for="year" class="col-sm-2 control-label">rok</label>
            <div class="col-sm-2">
                <select class="form-control" id="year" ng-options="x for x in years" name="year" ng-model="selectedOption"></select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <!-- <span class="col-sm-10 error" id="yearErr">{{yearErr}}</span> -->
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label for="place" class="col-sm-2 control-label">miejsce</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="place" maxlength="45" name="place" ng-value="current.place">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <!-- <span class="col-sm-10 error" id="placeErr">{{placeErr}}</span> -->
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label for="executor" class="col-sm-2 control-label">wykonawca</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="executor" maxlength="45" name="executor" ng-value="current.executor">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <!-- <span class="col-sm-10 error" id="executorErr">{{executorErr}}</span> -->
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label for="architect" class="col-sm-2 control-label">architekt</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="architect" maxlength="45" name="architect" ng-value="current.architect">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <!-- <span class="col-sm-10 error" id="architectErr">{{architectErr}}</span> -->
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label for="type" class="col-sm-2 control-label">typ</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="type" maxlength="45" name="type" ng-value="current.type">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <!-- <span class="col-sm-10 error" id="typeErr">{{typeErr}}</span> -->
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label for="style" class="col-sm-2 control-label">styl</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="style" maxlength="45" name="style" ng-value="current.style">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <!-- <span class="col-sm-10 error" id="styleErr">{{styleErr}}</span> -->
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label for="objectType" class="col-sm-2 control-label">typ obiektu</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="objectType" maxlength="45" name="objectType" ng-value="current.objectType">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <!-- <span class="col-sm-10 error" id="objectTypeErr">{{objectTypeErr}}</span> -->
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label for="yardage" class="col-sm-2 control-label">metraż</label>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="form-control" id="yardage" name="yardage" ng-model="yardage" ng-pattern="/^(\d+((,|\.)\d{1,2})?)?$/" ng-value="current.yardage">
                    <div class="input-group-addon">m<sup>2</sup></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <span class="col-sm-10 error" id="yardageErr" ng-show="addProjectForm.yardage.$error.pattern">liczba musi być prawidłowa (maksymalnie 2 miejsca po przecinku)</span>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label for="price" class="col-sm-2 control-label">cena</label>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="form-control" id="price" name="price" ng-model="price" ng-pattern="/^(\d+((,|\.)\d{1,2})?)?$/" ng-value="current.price">
                    <div class="input-group-addon">zł</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <span class="col-sm-10 error" id="priceErr" ng-show="addProjectForm.price.$error.pattern">liczba musi być prawidłowa (maksymalnie 2 miejsca po przecinku)</span>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label for="tags" class="col-sm-2 control-label">tagi</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="tags" name="tags" ng-value="tags">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <!-- <span class="col-sm-10 error" id="tagsErr">{{tagsErr}}</span> -->
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label class="col-sm-2 control-label">zdjęcia</label>
            <div id="imagesUpload" class="col-sm-10">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <!-- <span class="col-sm-10 error" id="filesErr">{{filesErr}}</span> -->
        </div>
    </div>
    <div class="row">
        <div class="col-sm-10"></div>
        <div class="col-sm-2">
            <button class="btn btn-success" type="submit" name="submit" ng-disabled="addProjectForm.$invalid">Zapisz</button>
        </div>
    </div>
</form>