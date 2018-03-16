import csv

with open("../data/shortDrugs.csv") as csvfile:
    drugs = csv.reader(csvfile)
    index = 0
    drugNames = []
    columnTitleRow = "drugName,drugPrescStat,price,manufNo,maxDosage,disease,quantity\n"
    newcsv = open("../data/newDrugs.csv", "w")
    newcsv.write(columnTitleRow)
    for row in drugs:
        if row[1] == "P" or row[1] == "O":
            drugName = row[0]
            if not(drugName in drugNames):
                drugNames.append(drugName)
                drugPrescStat = row[1]
                price = row[2]
                manufNo = row[3]
                maxDosage = row[4]
                disease = row[5]
                quantity = "2000"
                rowNew = drugName + "," + drugPrescStat + "," + price + "," + manufNo + "," + maxDosage + "," + disease + "," + quantity + "\n"
                newcsv.write(rowNew)
    print("done")






