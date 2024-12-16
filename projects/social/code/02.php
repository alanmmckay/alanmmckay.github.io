<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
file_object = open("edge_list.csv","r")
data = file_object.readlines()
file_object.close()

inBoundDict = dict()
outBoundNodes = set()
for line in data:
    switch = False
    outBoundNode = ""
    inBoundNode = ""
    for character in line:
        if switch == False:
            if character == ",":
                switch = True
                outBoundNodes.add(outBoundNode)
            else:
                outBoundNode += character
        else:
            if character == "\n":
                if inBoundNode not in inBoundDict:
                    inBoundDict[inBoundNode] = []
                inBoundDict[inBoundNode].append(outBoundNode)
            else:
                inBoundNode += character
<?php
    require($root_directory."code_footer.html");
?>
