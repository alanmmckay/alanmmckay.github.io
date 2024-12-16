<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
import matplotlib.pyplot as plt
import numpy as np

def distribution_graphing(dictionary,name=None):
    x = []
    y = []

    keys = list(dictionary.keys())
    keys.sort()

    total = sum([dictionary[i] for i in dictionary])

    for k in keys:
        x.append(k)
        y.append(dictionary[k]/total)

    x = np.array(x)
    y = np.array(y)

    plt.xlabel("node degree (k)")
    plt.ylabel("Proportion of nodes with degree (k)")
    plt.title("Distribution function of "+name)
    plt.scatter(x,y)
    plt.savefig("df-"+name+".png")
    plt.show()
<?php
    require($root_directory."code_footer.html");
?>
