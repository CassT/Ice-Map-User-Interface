# PullFromSidads.py
# This script requires lftp, and all the prerequisite modules for sigrid3rdf.py
import os

ftpData = "ftp://sidads.colorado.edu/pub/DATASETS/NOAA/G02171/"
virtDir = "/usr/local/virtuoso/share/virtuoso/vad/ICEDATA/"
lfc = open( "/usr/tmp/lftpCom.txt", "w" )
lfc.write( "ls */*/ \r\nquit" )
lfc.close()
os.system("lftp " + ftpData + " < /usr/tmp/lftpCom.txt > /usr/tmp/UrlList.txt")
Regions = ["East_Coast","Eastern_Arctic","Great_Lakes","Hudson_Bay","Western_Arctic"]
ins = open( "/usr/tmp/UrlList.txt", "r" )
for line in ins:
    for region in Regions:
        if region in line:
            Mid_URL = line[:len(line)-2]+"/"
    if "cis" in line:
        tarball   = line[line.index("cis"):len(line)-1]
        filename  = virtDir+tarball[:len(tarball)-3]+"ttl"
        shapefile = ftpData + Mid_URL + tarball
        print "Now creating " + filename + "."
        #This script was run from the same directory where I had sigrid3rdf.py, could alternately put both scripts in the user's path and execute without 'python'
        os.system("python sigrid3rdf.py "+shapefile+" "+filename)
        #The /tmp/ directory gets filled up extremely quickly by the sigrid3rdf.py script, so clean it after each conversion
        os.system("rm -rf /tmp/*")
ins.close()
os.system("rm /usr/tmp/UrlList.txt && rm /usr/tmp/lftpCom.txt")

