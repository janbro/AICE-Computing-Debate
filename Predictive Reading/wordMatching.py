prob = []
trueNames = []
fil = "C:/Users/Alejandro/Documents/GitHub/Python/BritishDictionary.txt"

names = open(fil, 'r').readlines()

redNames = ["can't"]

charSum = 0.0
lowest = 9999.0
topName = ""
toptopProb=0.0

#print redNames
while(True):
    del redNames[:]
    redNames.append(raw_input("Type word:"))
    for redName in redNames:
        redName = redName.lower()
        for n in names:
            n = n.lower()
            nChar = 0
            for ch in redName:
                rnChar = 0
                found=False
                closest = 1
                for c in n:
                    temp = 999
                    if ch is c:
                        found=True
                        temp = abs(nChar - rnChar)
                    if temp<closest:
                        closest = temp
                    rnChar+=1
                if not found:
                    charSum+=1.0
                else:
                    charSum+=closest
                nChar+=1
            if (float(charSum)+abs(len(redName)-len(n)))/len(redName)<lowest:
                lowest = (float(charSum)+abs(len(redName)-len(n)))/len(redName)
                toptopProb = lowest
                topName = n
            charSum = 0
        lowest = 99999
        trueNames.append(topName[:len(topName)-1])
        print "LOWEST"
        print topName
        print redName
        print toptopProb
        print "-------"

    print "top"
    print trueNames
    print redNames
    del trueNames[:]
