LOCAL=./
REMOTE=fuwafuwa@fuwafuwa.web.id:www/snippet.fuwafuwa.web.id/
SRC="$LOCAL"
DEST="$REMOTE"
EXCLUDE="--exclude=.well-known --exclude=node_modules --exclude=tmp --exclude=fuwafuwa.db --exclude=.git --exclude=sync.sh --exclude=_docs --exclude=config.ini --exclude=.htaccess"
while getopts "rind" o; do
  case $o in
    r) 
    SRC="$REMOTE"
    DEST="$LOCAL"
     ;;
     i) # initial upload
     EXCLUDE="--exclude=.well-known --exclude=node_modules --exclude=.git --exclude=_docs"
     ;;
     d) # update sqlite database
     EXCLUDE="--exclude=.well-known --exclude=node_modules --exclude=tmp --exclude=.git --exclude=sync.sh --exclude=_docs --exclude=.htaccess"
     ;;
     n)
     N=n
     ;;
  esac
done

rsync -avz$N --delete $EXCLUDE -e 'ssh -p 65002' "$SRC" "$DEST"