# storage/python-scripts/get_printers.py
import win32print
import json

def get_printers():
    printers = [printer[2] for printer in win32print.EnumPrinters(2)]
    return printers

if __name__ == "__main__":
    printer_list = get_printers()
    print(json.dumps({'printers': printer_list}))
