	<style>
    #home #home-search-box {
        position: absolute;
        top: 10%;
        left: 0;
        right: 0;
        margin:0 auto;
        display: block;
        width: 500px;
        height:250px !important;
        z-index: 101;
        background: linear-gradient(to top, rgba(0,192,65,.7), rgba(0,40,216,.7)); 
        box-shadow:5px 5px 5px #333;
        border:1px solid #000;
    }
    </style> 

   
  <div id="home-search-box" align="center" style="padding-top:37px;">
	<? require("members/search-form-inc.php"); ?>
  </div>
