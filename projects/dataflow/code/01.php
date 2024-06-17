<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
        &lt;Aggregation&gt; :: (&lt;Personas&gt; | &lt;Devices&gt;)
                         &lt;Platforms&gt;

           &lt;Personas&gt; :: &lt;Persona&gt; &lt;Personas&gt; | ∅

            &lt;Persona&gt; :: &lt;Browsing History&gt;
                         &lt;Disclosure History&gt;

   &lt;Browsing History&gt; :: &lt;Platforms&gt; &lt;Devices&gt;

          &lt;Platforms&gt; :: &lt;Platform&gt; &lt;Platforms&gt; | ∅

           &lt;Platform&gt; :: &lt;Target Demographics&gt;
                         &lt;Content Categories&gt;
                         &lt;Entities&gt; &lt;Devices&gt;

            &lt;Devices&gt; :: &lt;Device&gt; &lt;Devices&gt; | ∅

             &lt;Device&gt; :: &lt;Hardware&gt; &lt;Software&gt;

           &lt;Entities&gt; :: &lt;Entity&gt; &lt;Entities&gt;

             &lt;Entity&gt; :: &lt;Tracker&gt; | &lt;Advertiser&gt; |
                         &lt;Platform&gt; | ∅

            &lt;Tracker&gt; :: &lt;Target Demographics&gt;
                         &lt;Content Categories&gt;

         &lt;Advertiser&gt; :: &lt;Target Demographics&gt;
                         &lt;Content Categories&gt;

&lt;Target Demographics&gt; :: &lt;Demographic&gt; &lt;Demographics&gt;

       &lt;Demographics&gt; :: &lt;Demographic&gt; &lt;Demographics&gt; | ∅
<?php
    require($root_directory."code_footer.html");
?>
