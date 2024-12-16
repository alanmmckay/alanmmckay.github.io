<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
file_object = open("adjacencyList.csv","r")
data = file_object.readlines()
file_object.close()

print(" --- considering outbound edges --- ")

edge_list_string = ""
outboundQty = 0
kmin = float("inf")
kmax = -kmin
kdictionary = dict()
raw = []

for line in data:
    outboundQty += 1
    outboundEdges = 0
    switch = False
    outBoundNode = ""
    for character in line: # Can be abstracted to a call to &lt;string&gt;.split()
        if switch == False:
            if character == ",":
                switch = True
                new_line = outBoundNode + ","
            else:
                outBoundNode += character
        else:
            if character == "," or character == '\n':
                new_data += new_line + "\n"
                new_line = outBoundNode + ","
                outboundEdges += 1
            else:
                new_line += character
    raw.append(outboundEdges)
    if outboundEdges &gt; kmax:
        kmax = outboundEdges
    if outboundEdges &lt; kmin:
        kmin = outboundEdges
    if outboundEdges not in kdictionary:
        kdictionary[outboundEdges] = 1
    else:
        kdictionary[outboundEdges] += 1

print("k_out min: " + str(kmin))
print("k_out max: " + str(kmax))
print("k_out distribution: " + str(kdictionary))

k_out_dictionary = kdictionary
out_raw = raw

# --- --- --- Saving Edge List --- --- --- #
# The edge list will be used to capture inbound degree

file_object = open("edge_list.csv","w")
file_object.write(edge_list_string)
file_object.close()
<?php
    require($root_directory."code_footer.html");
?>
