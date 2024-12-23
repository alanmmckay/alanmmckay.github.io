<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
import powerlaw

def power_law_graphing(dictionary,raw,name):
    x = []
    y = []
    keys = list(dictionary.keys())
    keys.sort()
    print(keys)
    total = len(raw)

    mmin = float('inf')
    mmax = -mmin
    for k in keys:
        x.append(k)
        y.append(dictionary[k]/total)
        if dictionary[k] &gt; mmax:
            mmax = dictionary[k]
        if dictionary[k] &lt; mmin:
            mmin = dictionary[k]

    x = np.array(x)
    y = np.array(y)
    plt.xscale("log")
    plt.yscale("log")
    plt.xlabel("node degree (k)")
    plt.ylabel("Proportion of nodes with degree (k)")
    plt.scatter(x,y)

    raw = np.array(raw)
    fit = powerlaw.Fit(np.array(raw),xmin=1,discrete=False)
    fit.power_law.plot_pdf(color = 'b',linestyle='--',linewidth=3)
    fit.plot_pdf(color='b')

    gammaFunctionX = []
    gammaFunctionY = []

    alpha = fit.power_law.alpha
    c = (alpha - 1)*mmin**(alpha-1)

    print('alpha= ', fit.power_law.alpha,'  sigma= ',fit.power_law.sigma, ' c= ',c)
    for i in range(0,keys[-1]):
        gammaFunctionX.append(i)
        gammaFunctionY.append(c/(i**alpha))

    gammaFunctionX = np.array(gammaFunctionX)
    gammaFunctionY = np.array(gammaFunctionY)
    plt.plot(gammaFunctionX, gammaFunctionY, color = 'r')

    plt.title("Power Law Distribution function of "+name)
    plt.savefig("pdf-"+name+".png")
    plt.show()
<?php
    require($root_directory."code_footer.html");
?>
