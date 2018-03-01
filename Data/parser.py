import csv
import random



def main():

	with open('newDrugs.csv') as f:
		reader = csv.reader(f)
		drug_list = list(reader)

	with open('CTD_diseases.csv') as d:
		reader2 = csv.reader(d)
		disease_list = list(reader2)

	no_dupes = set()
	parsed = []
	header = drug_list[0]
	header.append("Disease")
	parsed.append(header)
	trunc_disease = []



	for row in range(1, len(drug_list), 6):
		drug_info = drug_list[row]
		drug_name = drug_info[0]

		if drug_name not in no_dupes:
			no_dupes.add(drug_name)
			parsed.append(drug_info)

	for _ in range(0, 400):
		disease_info = disease_list[random.randrange(60, 11000)]
		disease_name = disease_info[0]

		for inner in range(0, len(disease_info)):
			disease_info[inner].replace(","," ")
			disease_info[inner].strip()
		
		trunc_disease.append(disease_info)
		
	
	for row in range(1, len(parsed)):
		disease_info = trunc_disease[random.randrange(0, len(trunc_disease)-1)]
		disease_name = disease_info[0]


		parsed[row].append(disease_name)

		for inner in range(0, len(parsed[row])):
			parsed[row][inner].strip()


	with open('shortDrugs.csv', 'wb') as csvfile:
		drugwriter = csv.writer(csvfile, delimiter=',', quoting=csv.QUOTE_MINIMAL)
		#map(drugwriter.writerow, parsed)
		for row in range(0, len(parsed)):
			print parsed[row]
			drugwriter.writerow(parsed[row])


	with open('shortDisease.csv', 'wb') as csvfile:
		diseasewriter = csv.writer(csvfile, delimiter=',', quoting=csv.QUOTE_MINIMAL)
		#map(drugwriter.writerow, parsed)
		for row in range(0, len(trunc_disease)):
			diseasewriter.writerow(trunc_disease[row])







main()