<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
import random

adjacencyList = dict()

nodeList = dict()

keys = [i for i in range(0,8129)]

edgeQty = 0
while edgeQty &lt; 17406:
    fromNode = random.randint(0,8128)
    toNode = random.randint(0,8128)
    if len(keys) &gt; 0:
        switch = True
        while switch:
            if fromNode in keys:
                keys.remove(fromNode)
                switch = False
            else:
                fromNode = random.choice(keys)
    if fromNode in keys:
        keys.remove(fromNode)
    if toNode in keys:
        keys.remove(toNode)
    if fromNode != toNode:
        if fromNode not in adjacencyList:
            adjacencyList[fromNode] = list()
        if toNode not in adjacencyList[fromNode]:
            adjacencyList[fromNode].append(toNode)
            edgeQty += 1

csvString = ""
for outNode in adjacencyList:
    lineString = str(outNode) + ','
    for inNode in adjacencyList[outNode]:
        lineString += str(inNode) + ','
    csvString += lineString[:-1] + '\n'

fileObject = open("adjacencyList.csv","w")
fileObject.write(csvString)
fileObject.close()
<?php
    require($root_directory."code_footer.html");
?>
