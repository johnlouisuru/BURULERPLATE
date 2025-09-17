<html>
    <head>
        <style>
            @import url('https://fonts.googleapis.com/css?family=Work+Sans:400,600');
        body {
        	margin: 0;
        	background: #222;
        	font-family: 'Work Sans', sans-serif;
        	font-weight: 800;
        }
        
        .containesr {
        	width: 100%;
        	margin: 0 auto;
        }
        
        header {
          background: #55d6aa;
        }
        
        header::after {
          content: '';
          display: table;
          clear: both;
        }
        
        .x {
          float: none;
        }
        
        .x ul {
          margin: 0;
          padding: 0;
          list-style: none;
        }
        
        .x li {
          display: inline-block;
          margin-left: 5px;
          padding-top: 0;
        
          position: relative;
        }
        
        .x a {
          color: #444;
          text-decoration: none;
          text-transform: uppercase;
          font-size: 15px;
        }
        
        .x a:hover {
          color: #000;
        }
        
        .x a::before {
          content: '';
          display: block;
          height: 5px;
          background-color: #444;
        
          position: absolute;
          top: 0;
          width: 0%;
        
          transition: all ease-in-out 250ms;
        }
        
        .x a:hover::before {
          width: 100%;
        }
        </style>

    </head>
    <header>
    <div class="containers">

      <nav class='x'>
        <ul>
          <?php 
            $sql = "select * from pscc";
                        $get_all_pscc = secure_query_no_params($pdo, $sql);
                                if($get_all_pscc){ 
                                  while($all_pscc = $get_all_pscc->fetch()){ ?>
                                      <li><a href="#"><?=$all_pscc['pscc_name']?></a></li>
                                  <?php
                                  }
                                }
          ?>
          <li><a href="#">ALL</a></li>
        </ul>
      </nav>
    </div>
  </header>
</html>
