<?php
/*
Plugin Name: Codedeyo image to text extractor
Plugin URI: https://wordpress.org/plugins/codedeyo-image-to-text-extractor/
Version: 1.0
Description: A cool plugin that enables you to extract text from any image easily form the backend.
Author: Adeleye Ayodeji
Author URI: http://adeleyeayodeji.com/
Text Domain: codedeyo-image-to-text-extractor
Domain Path: /languages
*/

/*  Copyright (c) 2019 by Adeleye Ayodeji (https://adeleyeayodeji.com/)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/


//Display settings navigation
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'codedeyo_image_to_text_extractor_link');
function codedeyo_image_to_text_extractor_link( $links ) {
  $links[] = '<a href="' .
    admin_url( 'admin.php?page=codedeyo-image-to-text-extractor' ) .
    '">' . __('Settings') . '</a>';
  return $links;
}
 
	// adding to the menu
	function codedeyo_image_to_text_extractor_menu(){
		add_menu_page('Codedeyo image to text extractor', 'Codedeyo image to text extractor', 'manage_options', 'codedeyo-image-to-text-extractor', 'codedeyo_image_to_text_extractor', '', 200);
	}
  //Loading custom script for the plugin
  function codedeyo_image_to_text_extractor_style(){
   
      wp_enqueue_style( 'style1-css', plugin_dir_url( __DIR__ ).'codedeyo-image-to-text-extractor/css/style2.css' );
      wp_enqueue_style( 'style2-css', plugin_dir_url( __DIR__ ).'codedeyo-image-to-text-extractor/css/style.css' );
      wp_enqueue_script( 'tesseract-js', plugin_dir_url( __DIR__ ).'codedeyo-image-to-text-extractor/js/tesseract.js' );
      //wp_enqueue_script( 'jquery-core-js', plugin_dir_url( __DIR__ ).'codedeyo-image-to-text-extractor/js/jquery-core.js' );
      wp_enqueue_script( 'semantic-js', plugin_dir_url( __DIR__ ).'codedeyo-image-to-text-extractor/js/jquery.js');
      wp_enqueue_script( 'semantic-js', plugin_dir_url( __DIR__ ).'codedeyo-image-to-text-extractor/js/tesseract-core.js');
      
      wp_enqueue_script( 'semantic-js', plugin_dir_url( __DIR__ ).'codedeyo-image-to-text-extractor/js/jquery.query.js');
      wp_enqueue_script( 'semantic-js', plugin_dir_url( __DIR__ ).'codedeyo-image-to-text-extractor/js/semantic.min.js');
      wp_enqueue_script( 'index-js', plugin_dir_url( __DIR__ ).'codedeyo-image-to-text-extractor/js/index.js');
    
    
  }
  // Action for the above functions
	add_action('admin_menu', 'codedeyo_image_to_text_extractor_menu');
  add_action('admin_enqueue_scripts', 'codedeyo_image_to_text_extractor_style');

	function codedeyo_image_to_text_extractor(){
    //plugin url generate
     $url_me = "codedeyo-image-to-text-extractor";
		?>
<!--Using wordpress DIV layout -->
<div class="wrap">

    <div class="ui container"> 
         <!--Logo begins HERE -->
        <div class="ui header">
            <img style="height: auto;width: 50%;" src="<?php echo plugin_dir_url( __DIR__ ).$url_me.'/img/imagetotext.png'; ?>">
        </div>
        <!--Logo ends HERE -->

         <!--Credit begins HERE -->
        <div class="ui desc">Developed by <a href="https://adeleyeayodeji.com/" target="_blank">Adeleye Ayodeji</a></div>
            <p style="font-weight: bold;font-size: 20px;text-align: center;">Paste this shotcode <code style="font-weight: bold;font-size: 20px;color: red;">[codedeyoimage]</code> to use in post or page</p>
         <!--Credit ends HERE -->
          <div class="ui grid stackable">
              <div class="ui row">

                <!--Choose image upload begins HERE -->
                <div class="fifteen wide column">
                  <div class="ui card">
                      <div class="ui content">
                        <h2 class="ui header">Choose image</h2>
                      </div>
                      <div class="ui content extra">
                         <label class="custom-file-upload">
                            <input id="file" type="file" onchange="proccess(window.lastFile=this.files[0])">  
                             <div class="content image">
                                 <img id="image" style="width: 100%;height: auto;cursor: pointer;" class="ui centered large image" src="<?php echo plugin_dir_url( __DIR__ ).$url_me.'/img/capture.png'; ?>" />
                              </div>
                              <center>Upload Image</center>
                        </label>
                      </div>
                  </div>
                </div>
                <!--Choose image upload ends HERE -->

                <!--Choose image outputs begins HERE -->
                    <div class="fifteen wide column" style="margin-top: 20px;">
                      <div class="ui card">
                        <div class="ui content">
                          <h2 class="ui header">Your result here</h2>
                        </div>
                        <div class="ui content content-result">
                          <div class='ui grid'>
                            <div class='ui row result'>
                              <div class="ui column placeholder">
                                No Output <br/>
                                <span>Choose a file to start</span>    
                              </div>
                            </div>
                          </div>  
                        </div>
                           <!--Credit begins HERE -->
                        <div class="content extra">
                          <small>Developed by <a href="https://adeleyeayodeji.com">Adeleye Ayodeji</a></small>
                        </div>
                        <!--Credit ends HERE -->
                      </div>
                    </div>
                     <!--Choose image outputs ends HERE -->

                      <!--Reset button begins HERE -->
                    <div class="fifteen wide column" style="margin-top: 20px;">
                      <center><a class="button button-primary button-hero load-customize hide-if-no-customize" href="<?php echo $_SERVER['PHP_SELF'].'?page=codedeyo-image-to-text-extractor'; ?>">Reset Output</a></center>
                    </div>
                     <!--Reset button ends HERE -->

              </div>
          </div>
         
    </div>
</div>

<!--Thanks for using my first cool and nice plugin. HAPPY </CODING> GUYS -->
		<?php
	}   
      // Adding shortcode
      function codedeyo_image_text()
      {
        $url_me = "codedeyo-image-to-text-extractor";
        
        $layer = "<div>"; ?>
         <!-- style 1 -->
  <link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url( __DIR__ ).'codedeyo-image-to-text-extractor/css/style2.css'; ?>">
  <!-- style 2 -->
    <link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url( __DIR__ ).'codedeyo-image-to-text-extractor/css/style.css'; ?>">
    <!-- JS -->
      <script type="text/javascript" src="<?php echo plugin_dir_url( __DIR__ ).'codedeyo-image-to-text-extractor/js/tesseract.js' ?>"></script>
      <script type="text/javascript" src="<?php echo plugin_dir_url( __DIR__ ).'codedeyo-image-to-text-extractor/js/jquery.js' ?>"></script>
      <script type="text/javascript" src="<?php echo plugin_dir_url( __DIR__ ).'codedeyo-image-to-text-extractor/js/tesseract-core.js' ?>"></script>
      <script type="text/javascript" src="<?php echo plugin_dir_url( __DIR__ ).'codedeyo-image-to-text-extractor/js/jquery.query.js' ?>"></script>
      <script type="text/javascript" src="<?php echo plugin_dir_url( __DIR__ ).'codedeyo-image-to-text-extractor/js/semantic.min.js' ?>"></script>
      <script type="text/javascript" src="<?php echo plugin_dir_url( __DIR__ ).'codedeyo-image-to-text-extractor/js/index.js' ?>"></script>
      <!-- JS ends here -->
        <div class="ui container"> 
         <!--Credit ends HERE -->
          <div class="ui grid stackable">
              <div class="ui row">

                <!--Choose image upload begins HERE -->
                <div class="fifteen wide column">
                  <div class="ui card">
                      <div class="ui content">
                        <h2 class="ui header">Choose image</h2>
                      </div>
                      <div class="ui content extra">
                         <label class="custom-file-upload">
                            <input id="file" type="file" onchange="proccess(window.lastFile=this.files[0])">  
                             <div class="content image">
                                 <img id="image" style="width: 100%;height: auto;cursor: pointer;" class="ui centered large image" src="<?php echo plugin_dir_url( __DIR__ ).$url_me.'/img/capture.png'; ?>" />
                              </div>
                              <center>Upload Image</center>
                        </label>
                      </div>
                  </div>
                </div>
                <!--Choose image upload ends HERE -->

                <!--Choose image outputs begins HERE -->
                    <div class="fifteen wide column" style="margin-top: 20px;">
                      <div class="ui card">
                        <div class="ui content">
                          <h2 class="ui header">Your result here</h2>
                        </div>
                        <div class="ui content content-result">
                          <div class='ui grid'>
                            <div class='ui row result'>
                              <div class="ui column placeholder">
                                No Output <br/>
                                <span>Choose a file to start</span>    
                              </div>
                            </div>
                          </div>  
                        </div>
                           <!--Credit begins HERE -->
                        <div class="content extra">
                          <small>Developed by <a href="https://adeleyeayodeji.com">Adeleye Ayodeji</a></small>
                        </div>
                        <!--Credit ends HERE -->
                      </div>
                    </div>
                     <!--Choose image outputs ends HERE -->

                      <!--Reset button begins HERE -->
                    <div class="fifteen wide column" style="margin-top: 20px;">
                      <center><a class="button button-primary button-hero load-customize hide-if-no-customize" href="">Reset Output</a></center>
                    </div>
                     <!--Reset button ends HERE -->

              </div>
          </div>
         
    </div>
       <?php $layer .= "</div>";
        return $layer;
      }

      add_shortcode('codedeyoimage', 'codedeyo_image_text');
    ?>