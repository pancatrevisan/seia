<!--outras sessões-->

<?php
    if (!defined('ROOTPATH')) {
        require '../root.php';
    }

    require_once ROOTPATH . '/utils/DBAccess.php';
    require_once ROOTPATH . '/program/ProgramController.php';
    require_once ROOTPATH . '/ui/modal.php';



    $db = new DBAccess();
    $SQL = "SELECT * FROM student WHERE student.id='" . $data['studentId'] . "'";
    $res = $db->query($SQL);
    $student_data = mysqli_fetch_array($res);
?>

<div class="corpo row mt-3" id="programacoes">
    <div class="container">

        <div class="row mt-3">
            <div class="col">
                <div class="container">
                    <div class="row row-2">

                        <div class="col-3">
                            <div class="card">

                                <div class="row">
                                    <div class="col">
                                        <img class="img-fluid rounded" src="<?php echo BASE_URL; ?>/data/student/<?php echo $student_data['id']; ?>/<?php echo $student_data['avatar']; ?>">
                                    </div>
                                </div>

                                <!--<div class='row'>
                                    <div class='col'>
                                        <a class='btn btn-lg btn-info text-light btn-block mt-3' href="<?php echo BASE_URL; ?>/professional/index.php?action=editStudent&studentId=<?php echo $student_data['id']; ?>"><i class="fas fa-arrow-left"></i>Voltar</a>
                                    </div>
                                </div>-->

                                <div class="card-body">

                                    <h4 class="card-header">
                                        <p class="titulo-card"><?php echo $student_data['name']; ?></p>
                                    </h4>

                                    <p class="card-text">Nascimento: <?php $date=date_create($student_data['birthday']); echo date_format($date,"d/m/Y"); ?></p>
                                    <p class="card-text">Endereço: <?php echo $student_data['city'];
                                    echo " - " . $student_data['state']; ?></p>
                                    <p class="card-text">Medicação: <?php echo $student_data['medication']; ?></p>                    

                                    <!--<a type="button" class="btn btn-lg btn-block btn-info" href="<?php echo BASE_URL;?>/professional/index.php?action=editStudent&studentId=<?php echo $data['student_id'];?>"> <i class="fas fa-arrow-left"></i>Voltar</a>-->

                                </div><!--card-body-->
                                
                            </div><!--card-->
                        </div><!--col-3-->

                        <div class="student-tools">
                            <div class="row alert alert-primary" role="alert">
                                <div class="col">
                                    <div id="chart_div"></div>
                                </div>
                            </div>

                            <div class="row alert alert-primary" role="alert" id="last-session">
                                <p class="titulo-card">Última Sessão</p>
                                <div class="col" id='lastSession'>                                    
                                </div>
                            </div>
                        </div>

                    </div><!--row-->

                    <div class="titulo-pagina">        
                        <h1>Ver outras sessões</h1>

                        <div class="texto"><div class="barra-horizontal"></div></div>

                    </div><!--titulo pagina-->

                    <div class="col-9">                           

                        <div class="row alert alert-primary" role="alert">

                            <div class='row'>
                                <div class='col'>
                                    <form class="form-inline">
                                        <div class="form-group mb-2">
                                            <p>De: </p>
                                            <input type="date" class="form-control" id="startDate">
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                            <p>Até: </p>
                                            <input type="date" class="form-control" id="endDate">
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                            <button onclick="filterDate()" type="button" class="btn btn-primary mb-2"><p id="centraliza">Filtrar</p></button>
                                        </div>
                                </div>

                                    <div class="form-group mx-sm-3 mb-2 form-centro">
                                        <button onclick="listAll()" type="button" class="btn btn-success botao-centro"><i class="fas fa-bars"></i>Listar todas</button>
                                    </div>
                                </form>
                            </div>
                                    
                        </div>

                    <div class="row alert alert-primary" role="alert">
                        <div class='col'>
                            <div class='row'>
                                <div class='col' id='sessions'>
                                    Nenhum resultado
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--col-9-->

                </div><!--container-->
            </div><!--col-->
        </div><!--row-->

    </div><!--container-->
</div><!--corpo-->

<script type="text/javascript">
    function filterDate(){
        var xhttp = new XMLHttpRequest();
        
        var activity = this;
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                var obj = JSON.parse(this.responseText, true);
                console.log(obj);
                listResults(obj);
            }
        };
        var startDate = document.getElementById('startDate').value;
        var endDate  = document.getElementById('endDate').value;

        console.log("sdate "+startDate +" edate "+endDate);
        if(startDate == null ||startDate.length <=0){
            document.getElementById('startDate').classList.add('border', 'border-danger');
        }else{
            document.getElementById('startDate').classList.remove('border');
            document.getElementById('startDate').classList.remove('border-danger');
        }
        if(endDate == null ||endDate.length <=0){
            document.getElementById('endDate').classList.add('border', 'border-danger');
        }else{
            document.getElementById('endDate').classList.remove('border');
            document.getElementById('endDate').classList.remove('border-danger');
        }
        
        if(endDate!=null && startDate!=null && endDate.length >0 && startDate.length >0){
            xhttp.open("GET", "<?php echo BASE_URL;?>/professional/index.php?action=getSessions_json&studentId=<?php echo $student_data['id'];?>&startDate="+startDate+"&endDate="+endDate, true);
            xhttp.send();
        }

        
    }
    function listAll(){
        var xhttp = new XMLHttpRequest();
        
        var activity = this;
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                var obj = JSON.parse(this.responseText, true);
                console.log(obj);
                listResults(obj);
            }
        };
        xhttp.open("GET", "<?php echo BASE_URL;?>/professional/index.php?action=getSessions_json&studentId=<?php echo $student_data['id'];?>", true);
        xhttp.send();
    }
    // Load the Visualization API and the corechart package.

    /*
        res: json result from db
    */
    function listResults(res){
        console.log(res);
        var container = document.getElementById('sessions');
        container.innerHTML = "";
        var i;
        for(i=0; i < res.length; i++){
            var sess = document.createElement('a');
            sess.classList.add('btn','btn-info', 'btn-lg','btn-block');
            var data = new Date(res[i]['spt_last_date']);
            sess.innerHTML = "Programa: "+ res[i]['sp_name'] + " Aplicador: "+res[i]['spt_professional_id'] +" Data: "+data.toLocaleDateString()+ " Horário de início: " + data.toLocaleTimeString();
            sess.href='<?php echo BASE_URL;?>/professional/index.php?action=sessionReport&sessionId='+res[i]['spt_id']+'&studentId='+res[i]['spt_student_id'];
            container.appendChild(sess);
        }
    }
    
    
    document.body.onload = function(){
        var xhttp = new XMLHttpRequest();
        
        var activity = this;
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log("repostsa");
                console.log(this.responseText);
                var res = JSON.parse(this.responseText, true);
                
                var container = document.getElementById('lastSession');
                 container.innerHTML = "";
                var sess = document.createElement('a');
                sess.classList.add('btn','btn-danger', 'btn-lg','btn-block');
                var data = new Date(res['last_date']);
                sess.innerHTML = "<p>Aplicador: "+res['professional_id'] +"</p><p>Data: "+data.toLocaleDateString()+ "</p><p>Horário de início: " + data.toLocaleTimeString()+"</p>";
                sess.href='<?php echo BASE_URL;?>/professional/index.php?action=sessionReport&sessionId='+res['id']+'&studentId='+res['student_id'];
                container.appendChild(sess);
            }
        };
        xhttp.open("GET", "<?php echo BASE_URL;?>/professional/index.php?action=getLastSession_json&studentId=<?php echo $student_data['id'];?>", true);
        xhttp.send();
    };
    
    
    
    /*google.charts.load('current', {
        'packages': ['corechart']
    });
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
    */
    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            ['Mushrooms', 3],
            ['Onions', 1],
            ['Olives', 1],
            ['Zucchini', 1],
            ['Pepperoni', 2]
        ]);

        // Set chart options
        var options = {
            'title': 'How Much Pizza I Ate Last Night',
            'width': 400,
            'height': 300
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>