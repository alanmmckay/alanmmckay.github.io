<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
print(" --- considering all edges - undirected graph info --- ")

allDict = dict()
for line in data:
    node = ""
    for character in line:
        if character == ',' or character == '\n':
            if node not in allDict:
                allDict[node] = 1
            else:
                allDict[node] += 1
            node = ""
        else:
            node += character

kmin = float("inf")
kmax = -kmin
kdictionary = dict()
raw = []

for node in allDict:
    count = allDict[node]
    raw.append(count)
    if count &gt; kmax:
        kmax = count
    if count &lt; kmin:
        kmin = count
    if count not in kdictionary:
        kdictionary[count] = 1
    else:
        kdictionary[count] += 1

print("k_total min: " + str(kmin))
print("k_total max: " + str(kmax))
print("k_total distribution: " + str(kdictionary))
<?php
    require($root_directory."code_footer.html");
?>
