import csv
import random


symptoms = ["Anemia", "Anxiety", "Aphasia", "Arrhythmia", 
"Blisters", "Clotting", "Osteopenia", "Incontinence", "Hives",
"Inflammation", "Cancer", "Catatonia", "Cellulitis", "Cold",
"Cough", "Colitis", "Cyanosis", "Confusion", "Concussion",
"Delirium", "Depression", "Diabetes", "Diarrhea", "Delusions",
"Drooling", "Dizziness", "Dysphagia", "Headache", "Heartburn",
"Hiccups", "Hemolysis", "Hyperventilation", "Jaundice", "Vertigo",
"Vomiting", "Rash", "Palpitations", "Paralysis", "Paranoia",
"Pleurisy", "Weakness"]


pathogens = ["Ebola", "Rhinovirus", "Clostridium", "E.coli", "HPV", "Influenza", 
"Rhabdovirus", "Arenavirus", "Flavivirus", "Marburg", "Hantavirus", "Chlamydia", "Brucella",
"Shigella", "Yersinia", "Microsporidia", "Cryptosporidium", "Cylcospora", "Toxoplasma"]


illness = ["Hemorrhagic Fever", "Black Plague", "Dengue Fever", "Rabies", "Insomnia", 
"Murdering Syndrome", "Death Plague", "LG syndrome", "Procrastination", "Obesity", 
"Being American", "Alcoholism", "Bipolar Disorder", "Sociopathy", "Schizophrenia", "Chunnibyou",
"Being a NEET", "ADHD", "Having a waifu", "Asthma", "Arthritis", "Bulimia", "Chickenpox",
"Coma", "Dystonia", "Earache", "Fibromyalgia","Gallstones", "Gastroenteritis", "Gout",
"Lupus", "Malaria", "Mumps", "Norovirus", "Nosebleed", "Pneumonia", "Psoriasis", "Scabies",
"Shingles", "Scoliosis", "Suicide", "Threadworms" , "Thirst", "Vampirism", "Lycanthropy"]



def main():

	with open('newDrugs.csv') as f:
		reader = csv.reader(f)
		drug_list = list(reader)

	with open('CTD_diseases.csv') as d:
		reader2 = csv.reader(d)
		disease_list = list(reader2)

	with open('symptoms.csv') as s:
		reader3 = csv.reader(s)
		symptoms_list = list(reader3)

	no_dupes = set()
	parsed = []
	header = drug_list[0]
	header.append("Stock")
	header.append("Disease")
	parsed.append(header)
	trunc_disease = []





	for row in range(1, len(drug_list), 6):
		drug_info = drug_list[row]
		drug_name = drug_info[0]

		if drug_name not in no_dupes:
			no_dupes.add(drug_name)
			randstock = random.randrange(20, 4000)
			drug_info.append(str(randstock))
			drug_info[0] = drug_info[0].split(' ', 1)[0]
			parsed.append(drug_info)

	for ill in illness:
		t_disease = []
		#randill = random.randrange(0, len(illness)-1)
		randsymp = random.randrange(0, len(symptoms_list)-1)
		randdur = random.randrange(5, 412)	
		randpath = random.randrange(0, len(pathogens)-1)
		t_disease.append(ill)
		t_disease.append(pathogens[randpath])
		t_disease.append(symptoms_list[randsymp][0])
		t_disease.append(symptoms_list[randsymp][1])
		t_disease.append(randdur)

		trunc_disease.append(t_disease)
		#print trunc_disease
		
		
		
	
	for row in range(1, len(parsed)):
		disease_info = trunc_disease[random.randrange(0, len(trunc_disease)-1)]

		disease_name = disease_info[0]


		parsed[row].append(disease_name)

		for inner in range(0, len(parsed[row])):
			parsed[row][inner].strip()



	with open('shortDrugs.csv', 'wb') as csvfile:
		drugwriter = csv.writer(csvfile, delimiter=',', quoting=csv.QUOTE_MINIMAL)
		#map(drugwriter.writerow, parsed)
		#drugwriter.writerow(parsed[0])
		for row in range(1, len(parsed)):
			parsed[row][0].strip()
			parsed[row][2] = random.randrange(1, 600)
			parsed[row][4] = random.randrange(1,350)
			#print parsed[row]
			drugwriter.writerow(parsed[row])


	with open('shortDisease.csv', 'wb') as csvfile:
		diseasewriter = csv.writer(csvfile, delimiter=',', quoting=csv.QUOTE_MINIMAL)
		#map(drugwriter.writerow, parsed)
		for row in range(0, len(trunc_disease)):
			diseasewriter.writerow(trunc_disease[row])

	with open('illnessSQL.csv', 'wb') as csvfile:
		diseasewriter = csv.writer(csvfile, delimiter=',', quoting=csv.QUOTE_MINIMAL)
		#map(drugwriter.writerow, parsed)
		for row in range(0, len(trunc_disease)):
			t_row = [] 
			t_row.append(trunc_disease[row][0])
			t_row.append(trunc_disease[row][1])
			t_row.append(trunc_disease[row][-1])
			diseasewriter.writerow(t_row)
	

					

	
	#with open('symptoms.csv', 'wb') as csvfile:
	#	symptomwriter = csv.writer(csvfile, delimiter=',', quoting=csv.QUOTE_MINIMAL)
	#	for row in range(0, len(symptoms)):
	#		print symptoms[row]
	#		symptomwriter.writerow([symptoms[row]])





main()