<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
print(" --- considering inbound edges --- ")

kmin = float("inf")
kmax = -kmint
kdictionary = dict()
raw = []

for node in inBoundDict:
    length = len(inBoundDict[node])
    raw.append(length)
    if length &gt; kmax:
        kmax = length
    if length &lt; kmin:
        kmin = length
    if length not in kdictionary:
        kdictionary[length] = 1
    else:
        kdictionary[length] += 1

#Capturing edge cases:
for node in outBoundNodes:
    if node not in inBoundDict:
        kmin = 0
        break

if kmin == 0:
    kdictionary[kmin] = 0
    for node in outBoundNodes:
        if node not in inBoundDict:
            kdictionary[kmin] += 1

print("k_in min: " + str(kmin))
print("k_in max: " + str(kmax))
print("k_in distribution: " + str(kdictionary))

k_in_dictionary = kdictionary
in_raw = raw
<?php
    require($root_directory."code_footer.html");
?>
