# CMAKE generated file: DO NOT EDIT!
# Generated by "Unix Makefiles" Generator, CMake Version 3.17

# Delete rule output on recipe failure.
.DELETE_ON_ERROR:


#=============================================================================
# Special targets provided by cmake.

# Disable implicit rules so canonical targets will work.
.SUFFIXES:


# Disable VCS-based implicit rules.
% : %,v


# Disable VCS-based implicit rules.
% : RCS/%


# Disable VCS-based implicit rules.
% : RCS/%,v


# Disable VCS-based implicit rules.
% : SCCS/s.%


# Disable VCS-based implicit rules.
% : s.%


.SUFFIXES: .hpux_make_needs_suffix_list


# Suppress display of executed commands.
$(VERBOSE).SILENT:


# A target that is always out of date.
cmake_force:

.PHONY : cmake_force

#=============================================================================
# Set environment variables for the build.

# The shell in which to execute make rules.
SHELL = /bin/sh

# The CMake executable.
CMAKE_COMMAND = /snap/cmake/301/bin/cmake

# The command to remove a file.
RM = /snap/cmake/301/bin/cmake -E rm -f

# Escaping for special characters.
EQUALS = =

# The top-level source directory on which CMake was run.
CMAKE_SOURCE_DIR = "/home/peterbrown/Scrivania/UNI/TERZO ANNO/Linguaggi e tecnologie per il web/ProgettoLTW"

# The top-level build directory on which CMake was run.
CMAKE_BINARY_DIR = "/home/peterbrown/Scrivania/UNI/TERZO ANNO/Linguaggi e tecnologie per il web/ProgettoLTW/build"

# Utility rule file for NightlyMemCheck.

# Include the progress variables for this target.
include CMakeFiles/NightlyMemCheck.dir/progress.make

CMakeFiles/NightlyMemCheck:
	/snap/cmake/301/bin/ctest -D NightlyMemCheck

NightlyMemCheck: CMakeFiles/NightlyMemCheck
NightlyMemCheck: CMakeFiles/NightlyMemCheck.dir/build.make

.PHONY : NightlyMemCheck

# Rule to build all files generated by this target.
CMakeFiles/NightlyMemCheck.dir/build: NightlyMemCheck

.PHONY : CMakeFiles/NightlyMemCheck.dir/build

CMakeFiles/NightlyMemCheck.dir/clean:
	$(CMAKE_COMMAND) -P CMakeFiles/NightlyMemCheck.dir/cmake_clean.cmake
.PHONY : CMakeFiles/NightlyMemCheck.dir/clean

CMakeFiles/NightlyMemCheck.dir/depend:
	cd "/home/peterbrown/Scrivania/UNI/TERZO ANNO/Linguaggi e tecnologie per il web/ProgettoLTW/build" && $(CMAKE_COMMAND) -E cmake_depends "Unix Makefiles" "/home/peterbrown/Scrivania/UNI/TERZO ANNO/Linguaggi e tecnologie per il web/ProgettoLTW" "/home/peterbrown/Scrivania/UNI/TERZO ANNO/Linguaggi e tecnologie per il web/ProgettoLTW" "/home/peterbrown/Scrivania/UNI/TERZO ANNO/Linguaggi e tecnologie per il web/ProgettoLTW/build" "/home/peterbrown/Scrivania/UNI/TERZO ANNO/Linguaggi e tecnologie per il web/ProgettoLTW/build" "/home/peterbrown/Scrivania/UNI/TERZO ANNO/Linguaggi e tecnologie per il web/ProgettoLTW/build/CMakeFiles/NightlyMemCheck.dir/DependInfo.cmake" --color=$(COLOR)
.PHONY : CMakeFiles/NightlyMemCheck.dir/depend

