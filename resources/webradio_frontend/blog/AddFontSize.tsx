import "@blocknote/mantine/style.css";
  import {
    type Components,
    useBlockNoteEditor,
    useComponentsContext,
    useEditorContentOrSelectionChange,
  } from "@blocknote/react";
  import { useEffect, useState } from "react";
   
  // Custom Formatting Toolbar Button to toggle blue text & background color.
  export const AddFontSize=()=>{
    const editor = useBlockNoteEditor();
   
    const Components = useComponentsContext() as Components;

    useEffect(()=> {
        console.log(editor.styleImplementations);
    },[editor])
   
    // Tracks whether the text & background are both blue.
    const [isSelected, setIsSelected] = useState<boolean>(
      editor.getActiveStyles().textColor === "blue" &&
        editor.getActiveStyles().backgroundColor === "blue"
    );
   
    // Updates state on content or selection change.
    useEditorContentOrSelectionChange(() => {
      setIsSelected(
        editor.getActiveStyles().textColor === "blue" &&
          editor.getActiveStyles().backgroundColor === "blue"
      );
    }, editor);
   
    return (
      <Components.FormattingToolbar.Button
        mainTooltip={"Add font size"}
        onClick={() => {
          editor.toggleStyles({
            textColor: "gray2",
            backgroundColor: "gray2",
          });
        }}
        
        >
        +
      </Components.FormattingToolbar.Button>
    );
  }
   