/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package hotelsaya;

import java.util.Scanner;
public class Main{
    static String name;
    static int type, waktu;
    static TarifHotel hotel = new TarifHotel();
    
    static void register(){
        System.out.println("Program Menginap Di Hotel");
        System.out.println("|           " + "| Superior       " + "| Deluxe       " + "| Premium      |");
        System.out.println("" + "" + "" + "");
        System.out.println("|1-2 Hari   " + "|100.000/night   " + "|150.000/night " + "|200.000/night |");
        System.out.println("|3-4 Hari   " + "|90.000/night    " + "|135.000/night " + "|180.000/night |");
        System.out.println("|>5 Hari    " + "|80.000/night    " + "|120.000/night " + "|160.000/night |");
        System.out.println("" + "" + "" + "");
        
        Scanner nama = new Scanner(System.in);
        System.out.print("\nMasukkan Nama: ");
        name = nama.next();
        hotel.setNama(name);
    }
    
    static void pilih(){
        System.out.println("\nTipe Kamar");
        System.out.println("1. Superior");
        System.out.println("2. Deluxe");
        System.out.println("3. Premium");
        
        Scanner pilih = new Scanner (System.in);
        System.out.print("Pilih Tipe Kamar : ");
        type = pilih.nextInt();
        hotel.setType(type);
    }
    
    static void waktu (){
        Scanner lama = new Scanner (System.in);
        System.out.print("Lama Menginap : ");
        waktu = lama.nextInt();
        hotel.setWaktu(waktu);
    }
    
    static void result(){
        System.out.println("\n===== Pembayaran =====");
        System.out.println("Nama : " + hotel.getNama());
        System.out.println("Tipe Kamar : " + hotel.get_kamar());
        System.out.println("Harga Penginapan : " + hotel.get_harga());
        System.out.println("Lama Menginap : " + hotel.getWaktu() + " Hari");
        System.out.println("Total Pembayaran : " + hotel.get_total());
    }
    
    static void pengulangan(){
        Scanner ulang = new Scanner(System.in);
        char pilih;
        
        System.out.println("Ingin Memesan Lagi? (y/n) : ");
        pilih = ulang.next().charAt(0);
        
        switch(pilih){
            case'y':
                alur();
                break;
            case 'n':
                System.out.println("Program Selesai. ");
                System.exit(0);
                break;
            default:
                System.out.println("Pilihan Tidak Ada !");
                System.exit(0);
        }
    }
    
    static void alur(){
        register();
        pilih();
        waktu();
        result();
        pengulangan();
    }
    public static void main(String[] args){
//        TODO Code application logic here
    alur();
    }
}