<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#demo" onclick="telDetail('','demographic', 'patientTab')">Demographic Profile</a></li>
  <li><a data-toggle="tab" href="#clinic" onclick="telDetail('','clinical', 'clinicTab')">Clinical History and Physical Examination</a></li>
  <li><a data-toggle="tab" href="#covid" onclick="telDetail('','covid', 'covidTab')">Covid-19 Screening</a></li>
  <li><a data-toggle="tab" href="#diag" onclick="telDetail('','diagnosis', 'diagTab')">Diagnosis/Assessment</a></li>
  <li><a data-toggle="tab" href="#plan" onclick="telDetail('','plan', 'planTab')">Plan of Management</a></li>
</ul>

<div class="tab-content">
  <div id="demo" class="tab-pane fade in active">
    <h3><b id="caseNO"></b></h3>
    <br>
    <div id="patientTab" class="disAble"></div>
  </div>
  <div id="clinic" class="tab-pane fade">
    <br>
    <div id="clinicTab" class="disAble"></div>
  </div>
  <div id="covid" class="tab-pane fade">
    <br>
    <div id="covidTab" class="disAble"></div>
  </div>
  <div id="diag" class="tab-pane fade">
    <br>
    <div id="diagTab" class="disAble"></div>
  </div>
  <div id="plan" class="tab-pane fade">
    <br>
    <div id="planTab" class="disAble"></div>
  </div>
  <div id="docorder" class="tab-pane fade">
    <br>
    <div id="docTab" class="disAble"></div>
  </div>
</div>