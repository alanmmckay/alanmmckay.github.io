<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
# !!! This is the same loop described earlier in the reading.
#     It has been expanded to allow progress reporting.
#     Note that this is only a subsection of the Aquatint script.

im2 = imageio.imread(filename)
Nix=im2.shape[0]
Niy=im2.shape[1]
grayimage=np.zeros([Nix,Niy])

rewrite_switch = True
for i in range(0,Nix):
        for j in range(0,Niy):
            blueComponent = im2[i][j][0]
            greenComponent = im2[i][j][1]
            redComponent = im2[i][j][2]
            grayValue = 0.07 * blueComponent + 0.72 * greenComponent + 0.21 * redComponent
            grayimage[i][j] = grayValue
            pass
        status_dict['progress'] = i / Nix
        if round((i * 100) / Nix) % 3 == 0:
            if rewrite_switch == True:
                write_to_json(filename.split('.')[-2]+'-status.json',json.dumps(status_dict))
                rewrite_switch = False
        else:
            rewrite_switch = True
status_dict["progress"] = 0

dsqin=1-grayimage/255.0
hsimage=plt.imshow(dsqin,cmap='Greys',aspect=1,interpolation='none')
#cb = plt.colorbar(hsimage)
plt.savefig(filename.split('.')[-2]+'-origin.jpg',dpi=300)

status_dict["origin"] = True
status_dict['finished'] += 1
write_to_json(filename.split('.')[-2]+'-status.json',json.dumps(status_dict))
<?php
    require($root_directory."code_footer.html");
?>
