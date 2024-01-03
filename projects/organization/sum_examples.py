def sum_a(aList):
    total = 0
    for value in aList:
        total += value
    return total

def sum_b(aList):
    total = 0
    length = len(aList)
    for index in range(0,length):
        value = aList[index]
        total += value
    return total

def sum_c(aList):
    total = 0
    index = 0
    length = len(aList)
    while index < length:
        value = aList[index]
        total = total + value
        index = index + 1
    return total

def sum_d(aList):
    listCopy = list(aList)
    total = 0
    length = len(listCopy)
    while length > 0:
        value = listCopy.pop()
        total = total + value
        length = len(listCopy)
    return total

def sum_e(aList):
    listCopy = list(aList)
    total = 0
    while len(listCopy) > 0:
        value = listCopy.pop()
        total = total + value
    return total

def sum_f(aList):
    total = sum(aList) #python's built-in sum function
    return total



def sum_g(aList):
    return sum(alist)

def sum_h_helper(aList,index):
    length = len(aList)
    if index >= length:
        return 0
    else:
        value = aList[index]
        return value + sum_h_helper(aList,index + 1)

def sum_h(aList):
    return sum_h_helper(aList,0)

def sum_i_helper(aList,index):
    length = len(aList)
    value = aList[index]
    if index >= (length - 1):
        return value
    else:
        return value + sum_i_helper(aList,index + 1)

def sum_i(aList):
    if len(aList) > 0:
        return sum_i_helper(aList,0)
    else:
        return 0

def sum_j_helper(aList,value):
    length = len(aList)
    if length <= 0:
        return value
    else:
        new_value = aList.pop()
        return value + sum_j_helper(aList,new_value)

def sum_j(aList):
    listCopy = list(aList)
    if len(listCopy) > 0:
        value = listCopy.pop()
        return sum_j_helper(listCopy,value)
    else:
        return 0

def sum_k(aList):
    if len(aList) <= 0:
        return 0
    else:
        value = aList[0]
        if len(aList) <= 1:
            return value
        else:
            other_values = aList[1:]
            return value + sum_k(other_values)

def sum_l(aList):
    if len(aList) <= 0:
        return 0
    elif len(aList) <= 1:
        return aList[0]
    else:
        return aList[0] + sum_l(aList[1:])

if __name__ == "__main__":
    case1 = [i for i in range(0,20)]
    case2 = [i*2 for i in range(0,20)]
    case3 = [i+3 for i in range(0,20)]
    case4 = [i for i in range(0,20,2)]
    case5 = []
    case6 = [10]

    result1 = sum(case1)
    result2 = sum(case2)
    result3 = sum(case3)
    result4 = sum(case4)
    result5 = sum(case5)
    result6 = sum(case6)

    print("--- Sum A ---")
    print(sum_a(case1) == result1)
    print(sum_a(case2) == result2)
    print(sum_a(case3) == result3)
    print(sum_a(case4) == result4)
    print(sum_a(case5) == result5)
    print(sum_a(case6) == result6)
    print()


    print("--- Sum B ---")
    print(sum_b(case1) == result1)
    print(sum_b(case2) == result2)
    print(sum_b(case3) == result3)
    print(sum_b(case4) == result4)
    print(sum_b(case5) == result5)
    print(sum_b(case6) == result6)
    print()


    print("--- Sum C ---")
    print(sum_c(case1) == result1)
    print(sum_c(case2) == result2)
    print(sum_c(case3) == result3)
    print(sum_c(case4) == result4)
    print(sum_c(case5) == result5)
    print(sum_c(case6) == result6)
    print()


    print("--- Sum D ---")
    print(sum_d(case1) == result1)
    print(sum_d(case2) == result2)
    print(sum_d(case3) == result3)
    print(sum_d(case4) == result4)
    print(sum_d(case5) == result5)
    print(sum_d(case6) == result6)
    print()


    print("--- Sum E ---")
    print(sum_e(case1) == result1)
    print(sum_e(case2) == result2)
    print(sum_e(case3) == result3)
    print(sum_e(case4) == result4)
    print(sum_e(case5) == result5)
    print(sum_e(case6) == result6)
    print()


    print("--- Sum F ---")
    print(sum_f(case1) == result1)
    print(sum_f(case2) == result2)
    print(sum_f(case3) == result3)
    print(sum_f(case4) == result4)
    print(sum_f(case5) == result5)
    print(sum_f(case6) == result6)
    print()


    print("--- Sum H ---")
    print(sum_h(case1) == result1)
    print(sum_h(case2) == result2)
    print(sum_h(case3) == result3)
    print(sum_h(case4) == result4)
    print(sum_h(case5) == result5)
    print(sum_h(case6) == result6)
    print()


    print("--- Sum I ---")
    print(sum_i(case1) == result1)
    print(sum_i(case2) == result2)
    print(sum_i(case3) == result3)
    print(sum_i(case4) == result4)
    print(sum_i(case5) == result5)
    print(sum_i(case6) == result6)
    print()


    print("--- Sum J ---")
    print(sum_j(case1) == result1)
    print(sum_j(case2) == result2)
    print(sum_j(case3) == result3)
    print(sum_j(case4) == result4)
    print(sum_j(case5) == result5)
    print(sum_j(case6) == result6)
    print()


    print("--- Sum K ---")
    print(sum_k(case1) == result1)
    print(sum_k(case2) == result2)
    print(sum_k(case3) == result3)
    print(sum_k(case4) == result4)
    print(sum_k(case5) == result5)
    print(sum_k(case6) == result6)
    print()


    print("--- Sum L ---")
    print(sum_l(case1) == result1)
    print(sum_l(case2) == result2)
    print(sum_l(case3) == result3)
    print(sum_l(case4) == result4)
    print(sum_l(case5) == result5)
    print(sum_l(case6) == result6)
    print()

