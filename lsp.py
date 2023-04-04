def garis():
         print("==================================")

garis()
print("Masukkan Tiga Buah Nilai")
angka1 = int(input("Nilai A : "))
angka2 = int(input("Nilai B : "))
angka3 = int(input("Nilai C : "))
garis()
angka = [angka1, angka2, angka3]
# membuat ascending
angka.sort()
print("Urutan Nilai Ascending : ", angka)
# membuat descending
angka.sort(reverse=True)
print("Urutan Nilai Descending : ", angka)
# MAX
if(angka1 > angka2 and angka1 > angka3):
    print("Nilai MAX : ", angka1)
elif(angka2 > angka1 and angka2 > angka3):
    print("Nilai MAX : ", angka2)    
elif(angka3 > angka1 and angka3 > angka2):
    print("Nilai MAX : ", angka3)
# MIN
if(angka1 < angka2 and angka1 < angka3):
    print("Nilai MIN : ", angka1)
elif(angka2 < angka1 and angka2 < angka3):
    print("Nilai MIN : ", angka2)
elif(angka3 < angka1 and angka3 < angka2):
    print("Nilai MIN : ", angka3)
    
# Rata Rata
rata_rata = int((angka1 + angka2 + angka3)/3)
print("Nilai RATA RATA : ", rata_rata)